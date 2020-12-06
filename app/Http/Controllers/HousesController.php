<?php

namespace App\Http\Controllers;

use App\House;
use App\Ville;
use App\Category;
use App\Comment;
use App\Reservation;
use App\Propriete;
use App\Valuecatpropriete;
use App\User;
use App\Message;
use App\Post;
use App\Admin;
use App\Notifications\ReplyToAnnonce;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\CreateHouseStep1Request;
use App\Http\Requests\CreateHouseStep2Request;
use App\Http\Requests\CreateHouseStep3Request;
use App\Http\Requests\CreateHouseStep4Request;
use App\Http\Requests\CreateHouseStep5Request;
use Illuminate\Http\Response;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use Session;
use Image;
use View;
use GooglePlaces;
use App\Http\Middleware\XSS;
use App\Mail\SendAnnonceConfirmation;
use App\Mail\SendAnnonceSuppression;
use Illuminate\Support\Facades\Mail;


class HousesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(House $house)
    {
        $today = Date::today()->format('Y-m-d');
        $categories = category::where('statut', '=', 1)->get();
        $houses = house::with('valuecatproprietes', 'proprietes', 'category', 'comments')
        ->where('end_date', '>=', $today)
        ->where('statut', 'Validé')
        ->where('disponible', 'oui')
        ->orderBy('id', 'desc')
        ->paginate(14);
        
        return view('houses.index')->with('houses', $houses)
                                    ->with('categories', $categories);
    }

    public function cabanes(House $house)
    {
        $today = Date::today()->format('Y-m-d');
        $categories = category::all();
        $houses = house::with('valuecatproprietes', 'proprietes', 'category')
        ->where('end_date', '>=', $today)
        ->where('statut', 'Validé')
        ->where('category_id', 3)
        ->where('disponible', 'oui')
        ->orderBy('id', 'desc')
        ->paginate(14);

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

        if(count($houses) > 0){
            return view('houses.index')->with('houses', $houses)
            ->with('categories', $categories)
            ->with('moyenneNote', $moyenneNote);
        } else {
            $houses = house::paginate(14);
            return view('houses.index')->with('houses', $houses)
            ->with('categories', $categories)
            ->with('moyenneNote', $moyenneNote);
        }
    }

    public function igloos(House $house)
    {
        $today = Date::today()->format('Y-m-d');
        $categories = category::all();
        $houses = house::with('valuecatproprietes', 'proprietes', 'category')
        ->where('end_date', '>=', $today)
        ->where('statut', 'Validé')
        ->where('category_id', 4)
        ->where('disponible', 'oui')
        ->orderBy('id', 'desc')
        ->paginate(14);

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

        if(count($houses) > 0){
            return view('houses.index')->with('houses', $houses)
            ->with('categories', $categories)
            ->with('moyenneNote', $moyenneNote);
        } else {
            $houses = house::paginate(14);
            return view('houses.index')->with('houses', $houses)
            ->with('categories', $categories)
            ->with('moyenneNote', $moyenneNote);
        }        
    }

    public function yourtes(House $house)
    {
        $today = Date::today()->format('Y-m-d');
        $categories = category::all();
        $houses = house::with('valuecatproprietes', 'proprietes', 'category')
        ->where('end_date', '>=', $today)
        ->where('statut', 'Validé')
        ->where('category_id', 5)
        ->where('disponible', 'oui')
        ->orderBy('id', 'desc')
        ->paginate(14);

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
        if(count($houses) > 0){
            return view('houses.index')->with('houses', $houses)
            ->with('categories', $categories)
            ->with('moyenneNote', $moyenneNote);
        } else {
            $houses = house::paginate(14);
            return view('houses.index')->with('houses', $houses)
            ->with('categories', $categories)
            ->with('moyenneNote', $moyenneNote);
        }
    }

    /**
     * Affiche les locations en fonction de ce qui est selectionné dans la barre de recherche
     *
     * @return \Illuminate\Http\Response
     */
    public function search(SearchRequest $request)
    {
        $categories = DB::table('categories')->where('statut','=', 1)->get();
        $datas = $request->flashOnly([ 'category_id', 'start_date', 'end_date', 'nb_personnes']);
        
        $today = Date::today();
        $start_date = Date::createFromFormat('!d/m/Y', $request->start_date)->format('Y-m-d');
        $end_date = Date::createFromFormat('!d/m/Y', $request->end_date)->format('Y-m-d');
        if($request->category_id == 1){
            $houses = house::with('valuecatproprietes', 'proprietes', 'category')
            ->where('statut', 'Validé')
            ->where('end_date', '>', $today)
            ->where('end_date', '>=', $end_date)
            ->orWhere('nb_personnes', '>=', $request->nb_personnes)
            ->where('disponible', '=', "oui")
            ->orderBy('id','DESC')
            ->paginate(6);
            return view('houses.index')->with('houses', $houses)
                                    ->with('categories', $categories)
                                    ->with('datas', $datas);
        }
        if($request->category_id > 1){
            $houses = house::with('valuecatproprietes', 'proprietes', 'category')
                ->where('statut', 'Validé')
                ->where('end_date', '>', $today)
                ->where('end_date', '>=', $end_date)
                ->where('disponible', '=', "oui")
                ->where('category_id', '=', $request->category_id)
                ->where('nb_personnes', '>=', $request->nb_personnes)
                ->paginate(6);

            if(count($houses) > 0){
                return view('houses.index')->with('houses', $houses)
                ->with('categories', $categories)
                ->with('datas', $datas)
                ->with('start_date', $start_date)
                ->with('end_date', $end_date)
                ->with('nb_personnes', $request->nb_personnes);
            } else {
                $houses = house::with('valuecatproprietes', 'proprietes', 'category')
                    ->where('statut', 'Validé')
                    ->where('end_date', '>', $today)
                    ->where('end_date', '>=', $end_date)
                    ->where('nb_personnes', '>=', $request->nb_personnes)
                    ->where('disponible', '=', "oui")
                    ->orderBy('id','DESC')
                    ->paginate(6);
                    return view('houses.index')->with('houses', $houses)
                                            ->with('categories', $categories)
                                            ->with('datas', $datas);
            }
            
        }
        else {
            $houses = house::with('valuecatproprietes', 'proprietes', 'category')
            ->where('statut', 'Validé')
            ->where('end_date', '>', $today)
            ->where('end_date', '>=', $end_date)
            ->where('disponible', '=', "oui")
            ->where('category_id', '=', $request->category_id)
            ->orWhere('nb_personnes', '>=', $request->nb_personnes)
            ->orderBy('id','DESC')
            ->paginate(6);
            return view('houses.index')->with('houses', $houses)
                                    ->with('categories', $categories)
                                    ->with('datas', $datas);
        }
    }

    public function create_step1(Request $request) { 
        $houseAdresse = $request->session()->get('houseAdresse');
        if($houseAdresse == NULL){
            $adresse = "";
        } else {
            $adresse = last($houseAdresse);
        }
        return view('houses.create_step1', [
            'adresse' => $adresse
        ]);
    }

    public function postcreate_step1(CreateHouseStep1Request $request) {
        $houseAdresse = session('houseAdresse', $request->adresse);
        $request->session()->push('houseAdresse', $request->adresse);

        $houseUser = session('houseUser', $request->user_id);
        $request->session()->push('houseUser', $request->user_id);
        return redirect('/house/create_step2');
    } 

    public function create_step2(Request $request) {        
        $houseTelephone = $request->session()->get('houseTelephone');
        if($houseTelephone == NULL){
            $phone = "";
        } else {
            $phone = last($houseTelephone);
        }
        return view('houses.create_step2', [
            'phone' => $phone
        ]);
    }

    public function postcreate_step2(CreateHouseStep2Request $request) {
        $houseTelephone = session('houseTelephone', $request->phone);
        $request->session()->push('houseTelephone', $request->phone);

        $houseUser = session('houseUser', $request->user_id);
        $request->session()->push('houseUser', $request->user_id);

        return redirect('/house/create_step3');
    }

    public function create_step3(Category $categories, Request $request) {
        $houseTitle = $request->session()->get('houseTitle');
        
        if($houseTitle == NULL){
            $title = "";
        } else {
            $title = last($houseTitle);
        }
        
        $houseTelephone = $request->session()->get('houseTelephone');
        
        if($houseTelephone == NULL){
            $phone = "";
        } else {
            $phone = last($houseTelephone);
        }

        $houseCategory = $request->session()->get('houseCategory');
        if($houseCategory == null){
            $categorySelected = "";
        } else {
            $categorySelected = last($houseCategory);
        }
        
        $categories = category::where('statut','=', 1)->get();

        $housePropriete = $request->session()->get('houseProprietes');

        $houseNbPersonnes = $request->session()->get('houseNbPersonnes');
        if($houseNbPersonnes == NULL){
            $nb_personnes = "";
        } else {
            $nb_personnes = last($houseNbPersonnes);
        }

        $houseStartDate = $request->session()->get('houseStartDate');
        if($houseStartDate == NULL){
            $start_date = "";
        } else {
            $start_date = last($houseStartDate);
        }

        $houseEndDate = $request->session()->get('houseEndDate');
        if($houseEndDate == NULL){
            $end_date = "";
        } else {
            $end_date = last($houseEndDate);
        }

        $houseDescription = $request->session()->get('houseDescription');
        if($houseDescription == NULL){
            $description = "";
        } else {
            $description = last($houseDescription);
        }
        
        return view('houses.create_step3', [
            'categories' => $categories,
            'title' => $title,
            'phone' => $phone,
            'houseCategory' => $houseCategory,
            'categorySelected' => $categorySelected,
            'housePropriete' => $housePropriete,
            'nb_personnes' => $nb_personnes,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'description' => $description
        ]);
    }

    public function postcreate_step3(CreateHouseStep3Request $request) {
        $categories = category::where('statut', '=', 1)->get();
        $lastCategory = category::where('statut', '=', 1)->orderBy('id', 'desc')->first();
        $houseTitle = session('houseTitle', $request->title);
        $request->session()->push('houseTitle', $request->title);

        $request->session()->push('houseCategory', $request->category_id);
        $houseCategory = $request->session()->get('houseCategory');
        $request->session()->push('houseCategory', $request->category_id);
        if(last($houseCategory) == null){
            $categorySelected = "";
        } else {
            $categorySelected = last($houseCategory);
        }
        $lastCategory = $categories->last();
        if($request->category_id > $lastCategory->id){
            $categorySelected = $request->category_id;
            return redirect()->back()->with('danger', 'Veuillez selectionner une categorie valide');
        }
        
        $houseNbPersonnes = session('houseNbPersonnes', $request->nb_personnes);
        $request->session()->push('houseNbPersonnes', $request->nb_personnes);

        $houseStartDate = session('houseStartDate', $request->start_date);
        $request->session()->push('houseStartDate', $request->start_date);

        $houseEndDate = session('houseEndDate', $request->end_date);
        $request->session()->push('houseEndDate', $request->end_date);

        $houseDescription = session('houseDescription', $request->description);
        $request->session()->push('houseDescription', $request->description);
        
        
        $housePropriete = $request->session()->pull('houseProprietes');
        $houseProprieteId = $request->session()->pull('houseProprietesId'); 

        $proprietesChecked = $request->input('propriete');

        $housePropriete = session('houseProprietes', $proprietesChecked);
        if($proprietesChecked != NULL){
            $i = 0;
            for($i=0;$i < count($proprietesChecked); $i++){
                var_dump($proprietesChecked[$i]);
                $request->session()->push('houseProprietes', $proprietesChecked[$i]);
            }
        }
        return redirect('/house/create_step4');
    }
    

    public function create_step4(Request $request) {
        $housePrice = $request->session()->get('housePrice');
        if($housePrice == NULL){
            $price = "";
        } else {
            $price = last($housePrice);
        }
        return view('houses.create_step4', [
            'price' => $price
        ]);
    }

    public function postcreate_step4(CreateHouseStep4Request $request) {
        $housePrice = session('housePrice', $request->price);
        $request->session()->push('housePrice', $request->price);

        return redirect('/house/create_step5');
    }

    public function create_step5(Request $request) {
        $housePhoto = $request->session()->get('housePhoto');
        if($housePhoto == NULL){
            $photo = "";
        } else {
            $photo = last($housePhoto);
        }
        return view('houses.create_step5', [
            'photo' => $photo
        ]);
    }

    public function postcreate_step5(CreateHouseStep5Request $request) {
        $houseAdresse = $request->session()->get('houseAdresse');
        $houseTitle = $request->session()->get('houseTitle');
        $houseUser = $request->session()->get('houseUser');
        $houseCategory = $request->session()->get('houseCategory');
        $houseTelephone = $request->session()->get('houseTelephone');
        $houseNbPersonnes = $request->session()->get('houseNbPersonnes');
        $houseStartDate = $request->session()->get('houseStartDate');
        $houseEndDate = $request->session()->get('houseEndDate');
        $houseDescription = $request->session()->get('houseDescription');
        $housePrix = $request->session()->get('housePrice');
        
        $housePhoto = session('housePhoto', $request->photo);
        $request->session()->push('housePhoto', $request->photo);
        
        $house = new house;
        $house->adresse = last($houseAdresse);
        $house->user_id = last($houseUser);
        $house->title = last($houseTitle);
        $house->category_id = last($houseCategory);
        $house->phone = last($houseTelephone);
        $house->nb_personnes = last($houseNbPersonnes);

        $date = Carbon::createFromFormat('d/m/Y', last($houseStartDate));
        $newFormat = Carbon::parse($date)->format('Y-m-d');
        $date2 = Carbon::createFromFormat('d/m/Y', last($houseEndDate));
        $newFormat2 = Carbon::parse($date2)->format('Y-m-d');
        $house->start_date = $newFormat;
        $house->end_date = $newFormat2;

        $house->description = last($houseDescription);
        $house->price = last($housePrix);
        $house->statut = "En attente de validation";
        $house->disponible = "oui";

        $housePropriete = $request->session()->get('houseProprietes');

        $picture = $request->file('photo');
        $filename  = time() . '.' . $picture->getClientOriginalExtension();
        $path = public_path('img/houses/' . $filename);
        Image::make($picture->getRealPath())->save($path);
        $house->photo = $filename;
        $house->save();
        if($housePropriete == null){

        } else {
            foreach($housePropriete as $proprietes){
                $valuecatProprietesHouse = new valuecatPropriete;
                $valuecatProprietesHouse->category_id = $house->category_id;
                $valuecatProprietesHouse->propriete_id = intval($proprietes);
                $valuecatProprietesHouse->house_id = $house->id;
                $valuecatProprietesHouse->reservation_id = 0;
                
                $valuecatProprietesHouse->save();
            }
        }
        
        //Message à envoyer à l'admin
        $post = new post;
        $post->name = Auth::user()->nom.' '.Auth::user()->prenom;
        $post->email = Auth::user()->email;
        $post->content = 'Une nouvelle annonce '.$house->title.' de '.Auth::user()->nom.' '.Auth::user()->prenom.' a été créé';
        $post->type = "annonce";
        $post->house_id = $house->id;
        $post->reservation_id = 0;
        $post->user_id = Auth::user()->id;
        $post->save();

        //Notifications à envoyer à l'admin
        $admins = Admin::all();
        foreach ($admins as $admin) {
            $admin->notify(new ReplyToAnnonce($post));
        }

        $user = User::find(Auth::user()->id);
        $user->notify(new ReplyToAnnonce($post));

        //Notification à envoyer à l'utilisateur
        $message = new message;
        $message->content = "Vous avez bien créé l'annonce ".$house->title.", notre équipe va vérifier le contenu et vous enverra un message, une fois votre annonce validée par notre équipe, elle sera consultable sur le site dans nos hébergements";
        $message->user_id = $house->user_id;
        $message->save();

        //envoi du mail de confirmation de la reservation
        Mail::to(Auth::user()->email)->send(new SendAnnonceConfirmation($house));

        $request->session()->forget('houseAdresse');
        $request->session()->forget('houseTelephone');
        $request->session()->forget('houseTitle');
        $request->session()->forget('houseCategory');
        $request->session()->forget('houseProprietes');
        $request->session()->forget('houseNbPersonnes');
        $request->session()->forget('houseStartDate');
        $request->session()->forget('houseEndDate');
        $request->session()->forget('houseDescription');
        $request->session()->forget('housePrice');
        $request->session()->forget('housePhoto');
        $request->session()->forget('houseUser');
        
        return redirect('/house/confirmation_create_house')->with('success', "Votre annonce a bien été créé, vous avez reçu un message");
    }

    public function confirmation_create_house(){
        return view('houses.confirmation_create_house');
    }

    public function json_propriete($id, $category){
        $house = house::find($id);
        
        $proprietes = propriete::where('category_id', $category)->get();
        $valuecatProprietesHouse = valuecatpropriete::where('category_id', $category) 
        ->where('house_id', $id)
        ->where('reservation_id','=', 0)
        ->get();

        $valArray = array();
        foreach($proprietes as $propriete){
            foreach($valuecatProprietesHouse as $val){
                if($val->propriete_id == $propriete->id){
                    array_push($valArray, $val);
                }
            }
        }
        return response()->json(["proprietes" => $proprietes,
                                 "house" => $house,
                                 "valArray" => $valArray]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show(House $house, Reservation $reservation)
    {
        $house = house::find($house->id);
        return view('houses.show', compact('house', 'id'))->with('house', $house);
    }


    public function mylocations($id) {
        $houseProfil = DB::table('users')
        ->select('users.*', 'houses.*')
        ->leftJoin('houses', 'houses.user_id','users.id')
        ->where('users.id', '=', $id)
        ->where('houses.id', '!=', NULL)
        ->get();
        return view('houses.mylocations', compact('houseProfil'))->with('data', Auth::user()->user);
    }

    public function note(House $house, Note $note) {
        $note = note::find($house->id);
        $house->title = $request->get('title');
        $house->idCategory = $request->get('idCategory');
        $house->price = $request->get('price');
    }
}
