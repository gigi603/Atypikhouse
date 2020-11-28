<?php

namespace App\Http\Controllers;

use App\User;
use App\House;
use App\Comment;
use App\Reservation;
use App\Category;
use App\Propriete;
use App\Valuecatpropriete;
use App\Ville;
use App\Post;
use App\Admin;
use App\Message;
use App\Newsletter;
use Illuminate\Http\Request;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\EditHouseRequest;
use App\Http\Requests\ReservationRequest;
use App\Notifications\ReplyToReservation;
use App\Notifications\ReplyToAnnonce;
use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\SendNewsletter;
use App\Mail\SendReservationAnnulationConfirmation;
use App\Mail\SendAnnonceSuppression;
use Illuminate\Support\Facades\Mail;
use Image;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use Session;

class UsersController extends Controller
{
    // Profile de l'utilisateur connecté
    public function profile() {
        $userData = DB::table('users')
        ->where('id', '=', Auth::user()->id)
        ->get();
        return view('user.profile', compact('userData'))->with('data', Auth::user());
    }

    // Modifie le profil (activation de la newsletter ou non) Envoie par mail si oui
    public function edit(EditUserRequest $request, $id) {
        $user = User::find($id);
        try {
            if($request->newsletter != 1) {
                $user->newsletter = 0;
                $user->save();
                return redirect()->back();
            } else {
                $user->newsletter = 1;
                $user->save();
                $newsletters = newsletter::all();
                foreach($newsletters as $newsletter){
                    Mail::to($user->email)->send(new SendNewsletter($newsletter));
                }
                return redirect()->back();
            }
        } catch(Exception $e){
        }
    }

    // Vue global des annonces
    public function houses(Request $request)
    {
        $user = $request->user();
        $houses = house::with('valuecatproprietes', 'proprietes', 'category', 'user')->where('user_id', '=', Auth::user()->id)
        ->where('disponible', '=', 'oui')->orderBy('id', 'desc')->paginate(12);
        
        return view('user.houses', compact('houses'));
    }
    
    // Vue de détail de l'annonce interface client/visiteur
    public function showHouse($id)
    {
        //Données de l'annonce
        $reservation = reservation::all();
        $house = house::find($id);

        //Notes de l'annonce
        $moyenneNote = 0;
        $nb5etoiles = 0;
        $nb4etoiles = 0;
        $nb3etoiles = 0;
        $nb2etoiles = 0;
        $nb1etoiles = 0;
        $nbTotalNote = 0;
        foreach($house->comments as $comment){
            if($comment->note > 0){
                $moyenneNote = $moyenneNote + $comment->note;
                $nbTotalNote++;
            }
            if($comment->note == 5){
                $nb5etoiles = $nb5etoiles + 1;
            }
            if($comment->note == 4){
                $nb4etoiles = $nb4etoiles + 1;
            }
            if($comment->note == 3){
                $nb3etoiles = $nb3etoiles + 1;
            }
            if($comment->note == 2){
                $nb2etoiles = $nb2etoiles + 1;
            }
            if($comment->note == 1){
                $nb1etoiles = $nb1etoiles + 1;
            }
        }
        if($moyenneNote > 0 && $nbTotalNote > 0){
            $moyenneNote = $moyenneNote / $nbTotalNote;
        }
        if (Auth::check()) {
            $locataire = comment::where('user_id', Auth::user()->id)->get();
            $client_reserved = reservation::where('house_id', $id)->where('user_id', Auth::user()->id)->get();
            
            return view('user.show')->with('reservation', $reservation)
                                    ->with('house', $house)
                                    ->with('locataire', $locataire)
                                    ->with('client_reserved', $client_reserved)
                                    ->with('moyenneNote', $moyenneNote)
                                    ->with('nb5etoiles', $nb5etoiles)
                                    ->with('nb4etoiles', $nb4etoiles)
                                    ->with('nb3etoiles', $nb3etoiles)
                                    ->with('nb2etoiles', $nb2etoiles)
                                    ->with('nb1etoiles', $nb1etoiles)
                                    ->with('nbTotalNote', $nbTotalNote);
        } else {
            return view('user.show')->with('reservation', $reservation)
                                    ->with('house', $house)
                                    ->with('moyenneNote', $moyenneNote)
                                    ->with('nb5etoiles', $nb5etoiles)
                                    ->with('nb4etoiles', $nb4etoiles)
                                    ->with('nb3etoiles', $nb3etoiles)
                                    ->with('nb2etoiles', $nb2etoiles)
                                    ->with('nb1etoiles', $nb1etoiles)
                                    ->with('nbTotalNote', $nbTotalNote);
        }
    }

    //Vue de détail de l'annonce interface de l'annonceur
    public function showhebergements($id)
    {
        $house = House::find($id);
        $client_reserved = reservation::where('house_id', $id)->where('user_id', Auth::user()->id)->get();
        return view('user.showhebergements')->with('house', $house)->with('client_reserved', $client_reserved);
                                              
    }
        
    //Page de modification de l'annonce à modifier
    public function editHouse($id, Request $request)
    {
        $categories = category::all();
        $house = house::find($id);

        if($house->category_id == null){
            $categorySelected = "";
        } else {
            $categorySelected = $house->category_id;
        }
        $proprietes = propriete::where('category_id', $house->category->id)->get();
        return view('user.edit')->with('house', $house)
                                ->with('categorySelected', $categorySelected)
                                ->with('categories', $categories)
                                ->with('proprietes', $proprietes);
    }

    // Mettre à jour l'annonce après avoir saisie les modifications
    public function updateHouse(EditHouseRequest $request, $id)
    {
        
        $house = house::find($id);
        $categories = category::where('statut','=', 1)->get();
        $houseCategoryEdit = $request->session()->get('houseCategoryEdit');
        $request->session()->push('houseCategoryEdit', $request->category_id);
        if($houseCategoryEdit == null){
            $categorySelected = "";
        } else {
            $categorySelected = last($houseCategoryEdit);
        }
        if($house->title != $request->title || $house->phone != $request->phone || $house->category_id != $request->category_id
        || $house->nb_personnes != $request->nb_personnes || $house->price != $request->price 
        || $house->adresse != $request->adresse || $house->photo != $request->photo
        || $house->description != $request->description || $house->start_date != $request->start_date 
        || $house->end_date != $request->end_date){
            $house->title = $request->title;
            $lastCategory = $categories->last();
            if($request->category_id > $lastCategory->id){
                $categorySelected = $request->category_id;
                return redirect()->back()->with('danger', 'Veuillez selectionner une categorie valide');
            }
            $house->category_id = $request->category_id;
            $house->nb_personnes = $request->nb_personnes;
            $house->phone = $request->phone;
            $house->price = $request->price;
            $house->adresse = $request->adresse;
            
            if($request->hasFile('photo')){
                $picture = $request->file('photo');
                $filename  = time() . '.' . $picture->getClientOriginalExtension();
                $path = public_path('img/houses/' . $filename);
                Image::make($picture->getRealPath())->resize(350, 225)->save($path);
                $house->photo = $filename;
            }
            $start_date = Carbon::createFromFormat('d/m/Y', $request->start_date);
            $start_date_date_format = Carbon::parse($start_date)->format('Y-m-d');
            $house->start_date = $start_date_date_format;

            $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date);
            $end_date_date_format = Carbon::parse($end_date)->format('Y-m-d');
            $house->end_date = $end_date_date_format;

            $house->description = $request->description;
            $house->save();
        }            
        
        $valueproprietesdelete = valuecatpropriete::where('house_id','=', $id)->where('reservation_id', '=', 0)->delete();

        if($request->nb_personne > 15 || $request->nb_personne < 0){
            $request->nb_personne = "";
        }
        if($request->propriete != NULL){
            foreach($request->propriete as $proprietes) {
                $valuecatProprietesHouse = new valuecatPropriete;
                $valuecatProprietesHouse->category_id = $request->category_id;
                $valuecatProprietesHouse->house_id = $house->id;
                $valuecatProprietesHouse->propriete_id = $proprietes;
                $valuecatProprietesHouse->reservation_id = 0;
                $valuecatProprietesHouse->save();
            }
        }
        $request->session()->forget('houseCategoryEdit');
        return redirect()->back()->with('categorySelected', $categorySelected)
                                 ->with('success', "L'hébergement de l'utilisateur a bien été modifié");
    }

    //Supprimer une annonce
    public function deleteHouse(Request $request, $id)
    {
        $user = User::find(Auth::user()->id);
        $house = house::find($id);
        $admins = admin::all();

        if($house->statut == "En attente de validation"){

            $house->disponible = "non";
            $house->save();

            $post = new post;
            $post->name = $user->nom.' '.$user->prenom;
            $post->email = $user->email;
            $post->content = "L'annonce ".$house->title." de ".$user->nom.' '.$user->prenom." a été supprimée";
            $post->type = "annonce";
            $post->house_id = $house->id;
            $post->reservation_id = 0;
            $post->user_id = $user->id;

            $post->save();
            Mail::to($house->user->email)->send(new SendAnnonceSuppression($house));
            

            return redirect()->back()->with('success', "Votre annonce a bien été supprimée");
        } else {
            $post = new post;
            $post->name = $user->nom.' '.$user->prenom;
            $post->email = $user->email;
            $post->content = "L'utilisateur ".$user->nom.' '.$user->prenom." veut supprimer l'annonce ".$house->title;
            $post->type = "annonce";
            $post->house_id = $house->id;
            $post->reservation_id = 0;
            $post->user_id = $user->id;
            $post->save();

            foreach ($admins as $admin) {
                $admin->notify(new ReplyToAnnonce($post));
            }

            return redirect()->back()->with('success', "Votre demande a bien été pris en compte, étant donné que votre annonce est en ligne, un message sera envoyé à l'administrateur qui supprimera votre annonce. N'oubliez pas vérifier vos notifications");
        }
    }

    //Vue global des reservations
    public function reservations(Request $request)
    {
        $today = Date::today()->format('Y-m-d');
        $reservations = reservation::with('house')
        ->where('end_date', '>=', $today)
        ->where('user_id', '=', Auth::user()->id)
        ->where('reserved', '=', 1)
        ->orderBy('id', 'desc')
        ->paginate(12);
        
        return view('user.reservations', compact('reservations'));
    }

    //Vue de détails des reservations
    public function showreservations($id)
    {
        $users = User::where('id', $id)->get();
        $houses = House::where('user_id', $id)->get();
        $reservations = reservation::with('house','user','category','proprietes', 'valuecatproprietes')->where('id','=',$id)->get();
        return view('user.showreservations')->with('houses', $houses)
                                            ->with('users', $users)
                                            ->with('reservations', $reservations);
    }

    //Annuler une reservation
    public function cancelreservation($id) {
        $today = Date::today()->format('Y-m-d');

        $reservations = reservation::with('house')->where('start_date', '>=', $today)
        ->where('end_date', '>=', $today)
        ->where('user_id', '=', Auth::user()->id)
        ->orderBy('id', 'desc')
        ->get();

        $reservation = reservation::find($id);
        $reservation->reserved = 0;
        $reservation->save();

        //Message à envoyer à l'utilisateur
        $message = new message;
        $message->content = "Vous avez annulé une réservation, pour la consulter veuillez aller dans 'mon espace' > 'Mes reservations annulées'";
        $message->user_id = Auth::user()->id;
        $message->save();

        //Notification envoyé à l'utilisateur
        $user = User::find(Auth::user()->id);
        $user->notify(new ReplyToReservation($message));

        //envoi du mail d'annulation de la reservation
        Mail::to($reservation->user->email)->send(new SendReservationAnnulationConfirmation($reservation));

        return redirect()->back()->with('success', "Votre demande a bien été pris en compte, votre réservation a bien été annulée, un email de confirmation vous a été envoyé");
    }

    //Vue global des reservations annulées
    public function reservationsannulees(Request $request)
    {
        $today = Date::today()->format('Y-m-d');
        $reservations = reservation::with('house')->where('reserved', '=', 0)
        ->where('user_id', '=', Auth::user()->id)
        ->orderBy('id', 'desc')
        ->paginate(12);
        
        return view('user.reservationsannulees', compact('reservations'));
    }

    //Vue de détails des réservations annulées
    public function showreservationsannulees($id)
    {
        $users = User::where('id', $id)->get();
        $houses = House::where('user_id', $id)->get();
        $reservation = reservation::find($id);
        return view('user.showreservationsannulees')->with('houses', $houses)
                                                    ->with('users', $users)
                                                    ->with('reservation', $reservation);
    }

    //Vue global des reservations passées
    public function historiques(Request $request)
    {
        $today = Date::today()->format('Y-m-d');
        $historiques = reservation::with('house')->where('start_date', '<=', $today)
        ->where('end_date', '<', $today)
        ->where('user_id', '=', Auth::user()->id)
        ->orderBy('id', 'desc')->paginate(12);
        return view('user.historiques', compact('historiques'));
    }

    //Vue de détails des reservations passées
    public function showhistoriques($id)
    {
        $users = User::where('id', $id)->get();
        $houses = House::where('user_id', $id)->get();
        $historique = reservation::find($id);
        return view('user.showhistoriques')->with('houses', $houses)
                                              ->with('users', $users)
                                              ->with('historique', $historique);
    }

    

    //Utilisateur ajoute un commentaire sur un logement qu'il a déjà reservé
    public function addComment(CommentRequest $request)
    {
        $comment = new Comment;
        $comment->comment = $request->comment;
        if($request->note == null){
            $comment->note = 0;
        } else {
            $comment->note = $request->note;
        }
        $comment->user_id = Auth::user()->id;
        if($comment->admin_id != 0){
            $comment->admin_id = Auth::user()->id;
        } else {
            $comment->admin_id = 0;
        }
        $comment->house_id = $request->house_id;
        $comment->save();
    
        Session::flash('success', 'Votre commentaire a bien été ajouté');
        return redirect()->back();
    }

}
