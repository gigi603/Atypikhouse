<?php

/**
 * A propos
 * Mentions Légales
 * Politique de confidentialité
 * Conditions générales d'utilisation
 * 
 */

namespace App\Http\Controllers;

use App\House;
use App\User;
use App\Category;
use App\Valuecatpropriete;
use App\Propriete;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Jenssegers\Date\Date;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = DB::table('categories')->get();
        return view('home')->with('categories', $categories);
    }

    public function apropos() {
        return view('apropos');
    }
    public function mentions_legales() {
        return view('mentions_legales');
    }
    public function politique_de_confidentialite() {
        return view('politique_de_confidentialite');
    }
    public function cgu() {
        return view('cgu');
    }
    public function cgv() {
        return view('cgv');
    }
    public function rgpd() {
        return view('rgpd');
    }
    public function faq() {
        return view('faq');
    }
}
