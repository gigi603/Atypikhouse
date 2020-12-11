<?php
namespace App\Http\Controllers;

use App\User;
use App\Admin;
use App\Category;
use App\House;
use App\Ville;
use App\Comment;
use App\Propriete;
use App\Post;
use App\Message;
use App\Reservation;
use App\Valuecatpropriete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;
use Image;
use App\Http\Requests\EditHouseAdminRequest;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProprieteRequest;
use Jenssegers\Date\Date;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\ChannelManager;
use App\Notifications\ReplyToMessage;
use App\Notifications\ReplyToAnnonce;
use App\Notifications\ReplyToAnnonceDemandeSuppression;
use App\Notifications\ReplyToNews;
use App\Mail\SendAnnonceSuppression;
use App\Mail\SendAnnonceSuppressionFromAdmin;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

     // Lisye des Utilisateurs
    public function listusers(User $users, Category $categories, Propriete $proprietes)
    {
        $proprietes = DB::table('proprietes')->get();
        $categories = DB::table('categories')->get();
        $users = user::paginate(10);
        $houses = DB::table('houses')->get();
        return view('admin.listusers')->with('users', $users)
                            ->with('categories', $categories)
                            ->with('proprietes', $proprietes)
                            ->with('houses', $houses);
    }

    public function deleteUser($id) {
        $house = user::find($id);
        $house->delete();
        return redirect()->back()->with('success', 'Le client a bien été supprimé');
    }

    //Notifications Message des clients (Ex: 3 nouveaux messages)
    public function listposts(Post $posts)
    {
        $posts = post::where('type', 'message')->orderBy('id', 'desc')->paginate(10);
        $userUnreadNotifications = auth()->user()->unreadNotifications;

        foreach($userUnreadNotifications as $userUnreadNotification) {
            $data = $userUnreadNotification->data;
            foreach($posts as $post){
                if($post->id == $data["post_id"]){
                    $post["unread"] = true;
                }
            }
        }
        return view('admin.listposts')->with('posts', $posts);
    }


    //Vue de détails de la notifications des messages clients
    public function showposts($id)
    {
        $post = post::find($id);

        $userUnreadNotifications = auth()->user()->unreadNotifications;
        foreach($userUnreadNotifications as $userUnreadNotification) {
            $data = $userUnreadNotification->data;
            if($post->id == $data["post_id"]){
                $userUnreadNotification->markAsRead();
            }
        }
        
        return view('admin.showposts')->with('post', $post);
    }

    //Notifications des clients inscrits (Ex: 3 nouveaux utilisateurs)
    public function listpostsuser(Post $posts)
    {
        $posts = post::where('type', 'utilisateur')->orderBy('id', 'desc')->paginate(10);
        $userUnreadNotifications = auth()->user()->unreadNotifications;

        foreach($userUnreadNotifications as $userUnreadNotification) {
            $data = $userUnreadNotification->data;
            foreach($posts as $post){
                if($post->id == $data["post_id"]){
                    $post["unread"] = true;
                }
            }
        }
        return view('admin.listposts_user')->with('posts', $posts);
    }

    //Vue de détails de la notifications des nouveaux clients inscrits
    public function showpostsuser($id)
    {
        $post = post::find($id);
        $userUnreadNotifications = auth()->user()->unreadNotifications;
        foreach($userUnreadNotifications as $userUnreadNotification) {
            $data = $userUnreadNotification->data;
            if($post->id == $data["post_id"]){
                $userUnreadNotification->markAsRead();
            }
        }
        return view('admin.showposts_user')->with('post', $post);
    }

    //Notifications des nouvelles annonces (Ex: 3 nouvelles annonces)
    public function listpostsannonce(Post $posts)
    {
        $posts = post::where('type', 'annonce')->orderBy('id', 'desc')->paginate(10);
        $userUnreadNotifications = auth()->user()->unreadNotifications;

        foreach($userUnreadNotifications as $userUnreadNotification) {
            $data = $userUnreadNotification->data;
            foreach($posts as $post){
                if($post->id == $data["post_id"]){
                    $post["unread"] = true;
                }
            }
        }
        return view('admin.listposts_annonce')->with('posts', $posts);
    }

    //Vue de détails de la notifications des nouvelles annonces créées
    public function showpostsannonce($id)
    {
        $post = post::find($id);
        $house = house::find($post->house_id);
        $userUnreadNotifications = auth()->user()->unreadNotifications;
        foreach($userUnreadNotifications as $userUnreadNotification) {
            $data = $userUnreadNotification->data;
            if($post->id == $data["post_id"]){
                $userUnreadNotification->markAsRead();
            }
        }
        return view('admin.showposts_annonce')->with('post', $post)->with('house', $house);
    }

    //Notifications des nouvelles annonces (Ex: 3 nouvelles annonces)
    public function listpostsannoncemodified(Post $posts)
    {
        $posts = post::where('type', 'modify_annonce')->orderBy('id', 'desc')->paginate(10);
        $userUnreadNotifications = auth()->user()->unreadNotifications;

        foreach($userUnreadNotifications as $userUnreadNotification) {
            $data = $userUnreadNotification->data;
            foreach($posts as $post){
                if($post->id == $data["post_id"]){
                    $post["unread"] = true;
                }
            }
        }
        return view('admin.listposts_annonce_modified')->with('posts', $posts);
    }

    //Vue de détails de la notifications des nouvelles annonces créées
    public function showpostsannoncemodified($id)
    {
        $post = post::find($id);
        $house = house::find($post->house_id);
        $userUnreadNotifications = auth()->user()->unreadNotifications;
        foreach($userUnreadNotifications as $userUnreadNotification) {
            $data = $userUnreadNotification->data;
            if($post->id == $data["post_id"]){
                $userUnreadNotification->markAsRead();
            }
        }
        return view('admin.showposts_annonce_modified')->with('post', $post)->with('house', $house);
    }

    public function listpostsdemandeannoncetodelete()
    {
        $posts = post::where('type','=', 'demande_delete_annonce')->orderBy('id', 'desc')->paginate(10);
        $userUnreadNotifications = auth()->user()->unreadNotifications;

        foreach($userUnreadNotifications as $userUnreadNotification) {
            $data = $userUnreadNotification->data;
            foreach($posts as $post){
                if($post->id == $data["post_id"]){
                    $post["unread"] = true;
                }
            }
        }
        return view('admin.listpostsdemandeannonce_to_delete')->with('posts', $posts);
    }

    public function showdemandeannoncetodelete($id)
    {
        $post = post::find($id);
        $house = house::find($post->house_id);
        $userUnreadNotifications = auth()->user()->unreadNotifications;

        $user = user::find($house->user_id);
        $userUnreadNotifications = auth()->user()->unreadNotifications;
        foreach($userUnreadNotifications as $userUnreadNotification) {
            $data = $userUnreadNotification->data;
            if($post->id == $data["post_id"]){
                $userUnreadNotification->markAsRead();
            }
        }

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

        return view('admin.showpostdemandeannonce_to_delete')->with('post', $post)
                                                ->with('house', $house)
                                                ->with('user', $user)
                                                ->with('moyenneNote', $moyenneNote)
                                                ->with('nb5etoiles', $nb5etoiles)
                                                ->with('nb4etoiles', $nb4etoiles)
                                                ->with('nb3etoiles', $nb3etoiles)
                                                ->with('nb2etoiles', $nb2etoiles)
                                                ->with('nb1etoiles', $nb1etoiles)
                                                ->with('nbTotalNote', $nbTotalNote);
    }

    //Suppressions des nouvelles annonces (Ex: 3 nouvelles annonces)
    public function listpostsannoncedeleted(Post $posts)
    {
        $posts = post::where('type', 'delete_annonce')->orderBy('id', 'desc')->paginate(10);
        $userUnreadNotifications = auth()->user()->unreadNotifications;

        foreach($userUnreadNotifications as $userUnreadNotification) {
            $data = $userUnreadNotification->data;
            foreach($posts as $post){
                if($post->id == $data["post_id"]){
                    $post["unread"] = true;
                }
            }
        }
        return view('admin.listposts_annonce_deleted')->with('posts', $posts);
    }

    //Vue de détails de la notifications des nouvelles annonces créées
    public function showannoncedeleted($id)
    {
        $post = post::find($id);
        $house = house::find($post->house_id);
        $user = user::find($house->user_id);
        $userUnreadNotifications = auth()->user()->unreadNotifications;
        foreach($userUnreadNotifications as $userUnreadNotification) {
            $data = $userUnreadNotification->data;
            if($post->id == $data["post_id"]){
                $userUnreadNotification->markAsRead();
            }
        }

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

        return view('admin.showannonce_deleted')->with('post', $post)
                                                ->with('house', $house)
                                                ->with('user', $user)
                                                ->with('moyenneNote', $moyenneNote)
                                                ->with('nb5etoiles', $nb5etoiles)
                                                ->with('nb4etoiles', $nb4etoiles)
                                                ->with('nb3etoiles', $nb3etoiles)
                                                ->with('nb2etoiles', $nb2etoiles)
                                                ->with('nb1etoiles', $nb1etoiles)
                                                ->with('nbTotalNote', $nbTotalNote);
    }

    //Notifications des nouvelles reservations (Ex: 3 nouvelles reservations)
    public function listpostsreservation(Post $posts)
    {
        $posts = post::where('type', 'reservation')->orderBy('id', 'desc')->paginate(10);
        $userUnreadNotifications = auth()->user()->unreadNotifications;

        foreach($userUnreadNotifications as $userUnreadNotification) {
            $data = $userUnreadNotification->data;
            foreach($posts as $post){
                if($post->id == $data["post_id"]){
                    $post["unread"] = true;
                }
            }
        }
        return view('admin.listposts_reservation')->with('posts', $posts);
    }

    //Vue de détails de la notification des nouvelles reservations des clients
    public function showreservation($id)
    {
        $post = post::find($id);
        $reservation = reservation::find($post->reservation_id);
        $userUnreadNotifications = auth()->user()->unreadNotifications;
        foreach($userUnreadNotifications as $userUnreadNotification) {
            $data = $userUnreadNotification->data;
            if($post->id == $data["post_id"]){
                $userUnreadNotification->markAsRead();
            }
        }
        return view('admin.showreservation')->with('post', $post)->with('reservation', $reservation);
    }

    //Notifications des nouvelles reservations (Ex: 3 nouvelles reservations)
    public function listpostsreservationannulee(Post $posts)
    {
        $posts = post::where('type', 'canceled_reservation')->orderBy('id', 'desc')->paginate(10);
        $userUnreadNotifications = auth()->user()->unreadNotifications;

        foreach($userUnreadNotifications as $userUnreadNotification) {
            $data = $userUnreadNotification->data;
            foreach($posts as $post){
                if($post->id == $data["post_id"]){
                    $post["unread"] = true;
                }
            }
        }
        return view('admin.listposts_reservation_annulee')->with('posts', $posts);
    }

    //Vue de détails de la notification des nouvelles reservations des clients
    public function showreservationannulee($id)
    {
        $post = post::find($id);
        $reservation = reservation::find($post->reservation_id);
        $userUnreadNotifications = auth()->user()->unreadNotifications;
        foreach($userUnreadNotifications as $userUnreadNotification) {
            $data = $userUnreadNotification->data;
            if($post->id == $data["post_id"]){
                $userUnreadNotification->markAsRead();
            }
        }
        return view('admin.showreservation_annulee')->with('post', $post)->with('reservation', $reservation);
    }

    //Liste des categories
    public function listcategories(Category $categories)
    {
        $categories = DB::table('categories')
        ->where('category', '!=', 'Tous')
        ->where('statut', '!=', 0)
        ->paginate(10);
        return view('admin.listcategories')->with('categories', $categories);
    }

    //Ajout d'une catégorie à la liste des catégories
    public function registercategory(CategoryRequest $request)
    {
        $users = user::all();
        $categories = category::all();
        $category = new category;
        $category->category = $request->category;
        if ($request->category == $category->category && $category->where('category', $category->category)->count() > 0 && $category->statut == 1){
                return redirect()->back()->with('danger', "La catégorie existe déjà")->with('categories', $categories);
        } else {
            $category->statut = 1;
            
            $category->save();
            
            foreach($users as $user){
                //Message à envoyer aux utilisateurs
                $message = new message;
                $message->content = "Lorsque vous créez une annonce vous pouvez dorénavent selectionner la catégorie '".$category->category."' parmis les types d'hébergements";
                $message->user_id = $user->id;
                $message->save();

                //Envoie la notification à tous les utilisateurs
                \Notification::send($user, new ReplyToNews($message));
            }
            
            return redirect()->route('admin.categories')->with('success', "La catégorie a bien été ajoutée, un message a été envoyé à tous les propriétaires")->with('categories', $categories);
        }
    }

    //Supprimer une catégorie
    public function deleteCategory($id)
    {
        $users = user::all();
        $category = category::find($id);

        if($category->statut == 0){
            return redirect()->back()->with('danger', "La catégorie '".$category->category."' est déjà désactivée");
        } else {
            $category->statut = 0;
            $category->save();

            foreach($users as $user){
                //Message à envoyer aux utilisateurs
                $message = new message;
                $message->content = "L'administrateur a supprimé la catégorie '".$category->category."', lorsque vous créérez une nouvelle annonce la catégorie '".$category->category."' ne sera plus disponible";
                $message->user_id = $user->id;
                $message->save();

                //Envoie la notification à tous les utilisateurs
                \Notification::send($user, new ReplyToNews($message));
            }

            return redirect()->back()->with('success', "La catégorie ".$category->category." a bien été supprimé, un message a été envoyé à tous les propriétaires");
        }
    }
    //Equipements des catégories
    public function proprietescategory(Request $request, Category $categories, $id)
    {
        $category = category::find($id);
        $proprietes = propriete::where('category_id', $id)->where('statut', '=', 1)->paginate(10);
        return view('admin.proprietes')->with('category', $category)
                                       ->with('proprietes', $proprietes);
    }

    //Ajout d'un equipement à une catégorie
    public function registerpropriete(ProprieteRequest $request)
    {
        $propriete = new propriete;
        $propriete->propriete = $request->propriete;
        $propriete->statut = 1;
        $propriete->category_id = $request->category_id;

        //Ne crée pas l'équipement si elle existe déjà
        if ($propriete->where('propriete', $propriete->propriete)->where('category_id', '=', $request->category_id)->count() > 0) {
            return redirect()->back()->with('danger', "L'équipement existe déjà");
        } else {
            //Crée un nouvel équipement
            $propriete->save();

            //Message à envoyer aux utilisateurs qui ont une annonce ayant la catégorie liée
            $users = user::all();
            foreach($users as $user){  
                $message = new message;
                $message->content = "L'equipement '".$propriete->propriete."' est désormais disponible sur les annonces ayant comme catégorie '".$propriete->category->category."'";
                $message->user_id = $user->id;
                $message->save();

                //Envoie la notification à tous les utilisateurs qui ont une annonce ayant la catégorie liée
                \Notification::send($user, new ReplyToNews($message));
            }
            return redirect()->route('admin.proprietes_category', ['id' => $request->category_id])->with('success', "L'equipement '".$propriete->propriete."' a bien été ajoutée, un message a été envoyé aux proprietaires ayant dans leur annonce la catégorie '".$propriete->category->category."'")->with('category_id', $request->category_id);
        }
    }

    // Supprimer l'equipement d'une catégorie
    public function deletepropriete(Request $request, $id)
    {
        $propriete = propriete::find($id);
        
        //Suppression de l'equipement en changeant le statut
        $propriete->statut = 0;
        $propriete->save();
        
        //Notif de la suppression de l'équipement lié à la catégorie
        $users = user::all();
        foreach($users as $user){
            $message = new message;
            $message->content = "L'equipement '".$propriete->propriete."' a été supprimée des annonces et n'est plus disponible lors de la création d'une annonce avec pour catégorie d'annonce '".$propriete->category->category."'";
            $message->user_id = $user->id;
            $message->save();

            //Envoie la notification à tous les utilisateurs
            \Notification::send($user, new ReplyToNews($message));
        }

        
        return redirect()->back()->with('success', "Votre équipement ".$propriete->propriete." a bien été supprimée, un message a été envoyé aux propriétaires ayant dans leur annonce la catégorie ".$propriete->category->category);
    }

    public function disableUser($id)
    {
        $user = user::find($id);
        $user->statut = 0;
        $user->save();

        return redirect()->back()->with('danger', "Le compte de l'utilisateur ".$user->prenom." ".$user->nom." a bien été désactivé");
    }

    public function activateUser($id)
    {
        $user = user::find($id);
        $user->statut = 1;
        $user->save();

        return redirect()->back()->with('success', "Le compte de l'utilisateur ".$user->prenom." ".$user->nom." a bien été activé");
    }

    public function editHouse($id)
    { 
        $categories = category::all();
        $house = house::find($id);

        if($house->category_id == null){
            $categorySelected = "";
        } else {
            $categorySelected = $house->category_id;
        }
        
        $proprietes = propriete::where('category_id', $house->category->id)->get();
        
        return view('admin.editHouse')->with('house', $house)
                                ->with('categories', $categories)
                                ->with('categorySelected', $categorySelected)
                                ->with('proprietes', $proprietes);
    }

    public function editHouseRead($id)
    { 
        $categories = category::all();
        $house = house::find($id);

        if($house->category_id == null){
            $categorySelected = "";
        } else {
            $categorySelected = $house->category_id;
        }
        
        $proprietes = propriete::where('category_id', $house->category->id)->get();
        
        return view('admin.editHouseRead')->with('house', $house)
                                ->with('categories', $categories)
                                ->with('categorySelected', $categorySelected)
                                ->with('proprietes', $proprietes);
    }

    public function valideHouse($id) {
        $house = house::find($id);
        $house->statut = "Validé";
        $house->save();

        $message = new message;
        $message->content = "L'administrateur a validé l'annonce ".$house->title;
        $message->user_id = $house->user_id;
        $message->save();
        $user = User::find($house->user_id);
        $user->notify(new ReplyToNews($message));

        return redirect()->back()->with('success-valide', "Vous avez bien validé cette annonce");
    }

    public function refuseHouse($id) {
        $house = house::find($id);
        $house->statut = "Refusé";
        $house->save();
        $message = new message;
        $message->content = "L'administrateur a refusé l'annonce ".$house->title." veuillez nous contacter via le formulaire de contact";
        $message->user_id = $house->user_id;
        $message->save();
        $user = User::find($house->user_id);
        $user->notify(new ReplyToNews($message));
        return redirect()->back()->with('success-valide', "Vous avez bien refusé cette annonce");

    }

    public function json_propriete($id, $category){
        $house = house::find($id);
        
        $proprietes = propriete::where('category_id', $category)->get();
        $valuecatProprietesHouse = valuecatpropriete::where('category_id', $category) 
        ->where('house_id', $id)
        ->where('reservation_id', '=', 0)
        ->get();

        $valArray = array();
        foreach($proprietes as $propriete){
            foreach($valuecatProprietesHouse as $val){
                if($val->propriete_id == $propriete->id){
                    array_push($valArray, $val);
                }
            }
        }
        //var_dump($valArray);
        return response()->json(["proprietes" => $proprietes,
                                 "house" => $house,
                                 "valArray" => $valArray]); 
    }

    public function updateHouse(EditHouseAdminRequest $request,Category $category, Ville $ville, House $house, $id)
    {
        $house = house::find($id);
        $user = User::find(Auth::user()->id);

        $categories = category::where('statut','=', 1)->get();
        $houseCategoryEditAdmin = $request->session()->get('houseCategoryEditAdmin');
        $request->session()->push('houseCategoryEditAdmin', $request->category_id);
        if($houseCategoryEditAdmin == null){
            $categorySelected = "";
        } else {
            $categorySelected = last($houseCategoryEditAdmin);
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
        $proprietes_category = propriete::where('category_id', '=', $request->category_id)->get();
        if(count($request->propriete) > 0){
            foreach($request->propriete as $proprietes) {
                $valuecatProprietesHouse = new valuecatPropriete;
                $valuecatProprietesHouse->category_id = $request->category_id;
                $valuecatProprietesHouse->house_id = $house->id;
                $valuecatProprietesHouse->propriete_id = $proprietes;
                $valuecatProprietesHouse->reservation_id = 0;
                $valuecatProprietesHouse->save();
            }   
        }
        if($house->statut != $request->statut){
            if($request->statut == "En attente de validation"){
                $house->statut = $request->statut;
                $house->save();
                $message = new message;
                $message->content = "L'administrateur a mise en attente votre annonce ".$house->title.", il vous enverra un autre message concernant les modifications que vous devez effectuer afin qu'il valide par la suite votre annonce";
                $message->user_id = $house->user_id;
                $message->save();

                $user->notify(new ReplyToNews($message));
                $request->session()->forget('houseCategoryEditAdmin');
                return redirect()->back()->with('categorySelected', $categorySelected)->with('success', "L'hébergement du propriétaire a bien été modifié, vous avez mise en attente l'annonce, un message a été envoyé au propriétaire de cette annonce");
            } 
            if($request->statut == "Validé") {
                $house->statut = $request->statut;
                $house->save();
                $message = new message;
                $message->content = "L'administrateur a validé votre annonce ".$house->title;
                $message->user_id = $house->user_id;
                $message->save();
                
                $user->notify(new ReplyToNews($message));
                $request->session()->forget('houseCategoryEditAdmin');
                return redirect()->back()->with('categorySelected', $categorySelected)->with('success', "L'hébergement du propriétaire a bien été modifié, un message a été envoyé au propriétaire de cette annonce");
            }
            if($request->statut == "Refusé") {
                $house->statut = $request->statut;
                $house->save();
                $message = new message;
                $message->content = "L'administrateur a refusé votre annonce ".$house->title;
                $message->user_id = $house->user_id;
                $message->save();
                
                $user->notify(new ReplyToNews($message));
                $request->session()->forget('houseCategoryEditAdmin');
                return redirect()->back()->with('categorySelected', $categorySelected)->with('success', "L'hébergement du propriétaire a bien été modifié, un message a été envoyé au propriétaire de cette annonce");
            }
        }
    
        if($request->photo == NULL){
            $request->photo = $house->first()->photo;
            $house->save();

            $message = new message;
            $message->content = "L'administrateur a modifié des informations sur votre annonce ".$house->title;
            $message->user_id = $house->user_id;
            $message->save();
            
            $user->notify(new ReplyToNews($message));
            $request->session()->forget('houseCategoryEditAdmin');
            return redirect()->back()->with('categorySelected', $categorySelected)->with('success', "L'hébergement de l'utilisateur a bien été modifié, un message a été envoyé au propriétaire de cette annonce");
        } else {
            $picture = $request->file('photo');
            $filename  = time() . '.' . $picture->getClientOriginalExtension();
            $path = public_path('img/houses/' . $filename);
            Image::make($picture->getRealPath())->resize(350, 200)->save($path);
            $house->photo = $filename;
            $house->save();

            $message = new message;
            $message->content = "L'administrateur a modifié des informations sur votre annonce ".$house->title;
            $message->user_id = $house->user_id;
            $message->save();
            $request->session()->forget('houseCategoryEditAdmin');
            return redirect()->back()->with('categorySelected', $categorySelected)->with('success', "L'hébergement du propriétaire a bien été modifié, un message a été envoyé au propriétaire de cette annonce");
        } 
    }

    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
    public function profilUser($id) {  
        $user = User::find($id);
        return view('admin.profilUser')->with('user', $user);
    }

    public function allreservations()
    {

        $reservations = Reservation::where('end_date', '>=', Carbon::today())->where('reserved', '=', 1)->orderBy('id', 'desc')->paginate(10);
        //dd($reservations);
        return view('admin.allreservations')->with('reservations', $reservations);
    }

    //Liste des reservations des utilisateurs
    public function listreservations($id)
    {
        $today = Date::today()->format('Y-m-d');
        $reservations = reservation::where('user_id','=', $id)->where('start_date', '>=', $today)
        ->where('reserved', '=', 1)->paginate(10);
        return view('admin.listreservations')->with('reservations', $reservations);
    }

    //Vue de détails des reservations des utilisateurs
    public function showreservations($id)
    {
        $users = User::where('id', $id)->get();
        $houses = House::where('user_id', $id)->get();
        $reservation = reservation::find($id);
        return view('admin.showreservations')->with('houses', $houses)
                                              ->with('users', $users)
                                              ->with('reservation', $reservation);
    }

    public function allreservationscancel()
    {
        $reservations = Reservation::where('reserved', '=', 0)->orderBy('id', 'desc')->paginate(10);
        return view('admin.allreservationscancel')->with('reservations', $reservations);
    }

    public function showreservationscancel($id)
    {
        $users = User::where('id', $id)->get();
        $houses = House::where('user_id', $id)->get();
        $reservation = reservation::find($id);
        return view('admin.showreservationscancel')->with('houses', $houses)
                                              ->with('users', $users)
                                              ->with('reservation', $reservation);
    }

    public function allhistoriques()
    {
        $today = Date::today()->format('Y-m-d');
        $historiques = Reservation::with('house')->where([
                                                    ['start_date', '<', $today],
                                                    ['end_date', '<', $today]
                                                ])->paginate(10);
        return view('admin.allhistoriques')->with('historiques', $historiques);
    }

    //Liste des reservations des utilisateurs
    public function listhistoriques($id)
    {
        $today = Date::today()->format('Y-m-d');
        $historiques = Reservation::with('house')->where([
                                                    ['start_date', '<', $today],
                                                    ['end_date', '<=', $today],
                                                    ['user_id','=', $id]
                                                ])->paginate(10);
        return view('admin.allhistoriques')->with('historiques', $historiques);
    }

    //Vue de détails des historiques des utilisateurs
    public function showhistoriques($id)
    {
        $user = User::where('id', $id)->get();
        $houses = House::where('user_id', $id)->get();
        $historique = reservation::find($id);
        return view('admin.showhistoriques')->with('houses', $houses)
                                              ->with('user', $user)
                                              ->with('historique', $historique);
    }

    //Liste des reservations des utilisateurs
    public function listreservationscancel($id)
    {
        $today = Date::today()->format('Y-m-d');
        $reservations = Reservation::with('house')->where([
                                                    ['reserved', '=', 0],
                                                    ['user_id','=', $id]
                                                ])->paginate(10);
        return view('admin.listreservationscancel')->with('reservations', $reservations);
    }
    
    public function allannonces()
    {
        $houses = House::where('disponible', "oui")->orderBy('id', 'desc')->paginate(10);

        
        return view('admin.allannonces')->with('houses', $houses);
    }
    //Vue de détails des annonces des utilisateurs
    public function listannonces($id)
    {
        $user = User::find($id);
        $houses = House::where('user_id', $id)->where('disponible', "oui")->paginate(10);
        $moyenneNote = 0;
        $nb5etoiles = 0;
        $nb4etoiles = 0;
        $nb3etoiles = 0;
        $nb2etoiles = 0;
        $nb1etoiles = 0;
        $nbTotalNote = 0;
        foreach($houses as $house){
            foreach($house->comments as $comment){
                if($comment->note > 0){
                    $moyenneNote = $moyenneNote + $comment->note;
                    $nbTotalNote++;
                }
            }
            if($moyenneNote > 0 && $nbTotalNote > 0){
                $moyenneNote = $moyenneNote / $nbTotalNote;
            }
        }
        return view('admin.listannonces')->with('houses', $houses)
                                         ->with('user', $user)
                                         ->with('moyenneNote', $moyenneNote);
    }

    public function showannonces($id)
    {
        $user = User::find($id);
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
        return view('admin.showannonces')->with('house', $house)
                                         ->with('user', $user)
                                         ->with('moyenneNote', $moyenneNote)
                                        ->with('nb5etoiles', $nb5etoiles)
                                        ->with('nb4etoiles', $nb4etoiles)
                                        ->with('nb3etoiles', $nb3etoiles)
                                        ->with('nb2etoiles', $nb2etoiles)
                                        ->with('nb1etoiles', $nb1etoiles)
                                        ->with('nbTotalNote', $nbTotalNote);
    }
    

    public function deleteHouse($id) {
        $house = house::find($id);
        $users = User::where('id', '=', $house->user_id)->get();
        //Supprime l'annonce en changeant le statut
        $house->disponible = "non";
        $house->save();

        //Envoie une notif à l'utilisateur de l'annonce
        $message = new message;
        $message->content = "L'administrateur a supprimé votre annonce ".$house->title;
        $message->user_id = $house->user_id;
        $message->save();

        foreach($users as $user){
            //Envoie la notification à l'annonceur
            $user->notify(new ReplyToNews($message));
        }
        //Envoie un mail de confirmation de la suppression de l'annonce
        Mail::to($house->user->email)->send(new SendAnnonceSuppressionFromAdmin($house));

        return redirect()->back()->with('success', "L'annonce a été supprimée, une notification a été envoyé sur le compte atypikhouse du propriétaire de l'annonce ainsi qu'un mail");
    }

    public function listcomments(Comment $comments, $id)
    {
        $comments = DB::table('comments')->join('houses', 'houses.id', '=', 'comments.house_id')
                                         ->join('users', 'users.id', '=', 'comments.user_id')
                                                ->where('comments.user_id','=', $id)
                                                ->paginate(10);
        return view('admin.listcomments')->with('comments', $comments);
    }

    public function addComment(CommentRequest $request)
    {
        $house = house::find($request->house_id);
        
        //$user = User::find(Auth::user()->id);

        //Créer le commentaire dans la bdd
        $comment = new Comment;
        $comment->comment = $request->comment;
        if($request->note == null){
            $comment->note = 0;
        } else {
            $comment->note = $request->note;
        }
        $comment->user_id = "0";
        $comment->admin_id = "1";
        $comment->house_id = $request->house_id;
        $comment->reservation_id = 0;
        $comment->parent_id = $request->parent_id;
        $comment->save();

        //Créer le message à envoyer à l'utilisateur
        $message = new message;
        $message->content = "Un administrateur a supprimé votre commentaire '".$comment->comment."' de l'annonce '".$house->title."'";
        $message->user_id = $comment->user_id;
        $message->save();

        Session::flash('success', 'Votre commentaire a bien été ajouté');
        return redirect()->back();
    }

    public function modifyComment(CommentRequest $request)
    {
        $comment = comment::find($request->parent_id);

        $comment->comment = $request->comment;
        if($request->note == null){
            $comment->note = 0;
        } else {
            $comment->note = $request->note;
        }
        $comment->save();
        Session::flash('success', 'Ce commentaire a bien été modifié');
        return redirect()->back();
    }

    public function deleteComment($id) {
        $comment = comment::find($id);
        $comment->delete();
        return redirect()->back()->with('success', 'Le commentaire a bien été supprimé');
    }

    public function deleteCommentParent($id) {
        $commentParent = comment::find($id);
        $commentsChild = comment::where('parent_id', $id)->get();

        foreach($commentsChild as $child){
            $child->delete();
        }
        $commentParent->delete();
        return redirect()->back()->with('success', 'Le commentaire a bien été supprimé');
    }

    public function note(House $house, Note $note) {
        $note = note::find($house->id);
        $house->title = $request->get('title');
        $house->idCategory = $request->get('idCategory');
        $house->price = $request->get('price');
    }

    public function messages($id) {
        $messages = message::where('user_id','=', $id)->orderBy('id', 'desc')->paginate(10);
        $user = user::find($id);
        return view('admin.user_messages')->with('messages', $messages)->with('user', $user);
    }

    public function addMessage(MessageRequest $request, $id) {
        $user = user::find($id);
        if($user != NULL){
            $message = new Message;
            $message->content = $request->content;
            $message->user_id = $id;
            $message->save();
            Session::flash('success-valide', 'Votre message a bien été envoyé');
            
            $user->notify(new ReplyToMessage($message));
            return redirect()->back();
        } else {
            Session::flash('error', "Votre message n'a bien été envoyé une erreur est survenue");
            return redirect()->back();
        }
    } 
}
