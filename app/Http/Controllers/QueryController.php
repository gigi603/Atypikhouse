<?php

namespace App\Http\Controllers;

use App\House;
use App\Category;
use App\Ville;
use \Date;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

/** Controller qui gère le système de recherche de locations se trouvant
 *  sur la page d'accueil et la page des locations
 */
class QueryController extends Controller
{
    /**
     * Affiche les locations en fonction de ce qui est selectionné dans la barre de recherche
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SearchRequest $request)
    {
        $categories = category::all();
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
                ->orWhere('nb_personnes', '>=', $request->nb_personnes)
                ->orderBy('id','DESC')
                ->paginate(6);

            if(count($houses) > 0){
                return view('houses.index')->with('houses', $houses)
                ->with('categories', $categories)
                ->with('datas', $datas);
            } else {
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
}
