<?php

namespace App\Console\Commands;

use Route;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
use App\User;
use App\House;
use App\Comment;
use App\Reservation;
use App\Category;
use App\Propriete;
use App\Valuecatpropriete;
use App\Ville;
use App\Post;
use App\Newsletter;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sitemap = Sitemap::create();

        $routeCollection = Route::getRoutes()->get();
        $id = "{id}";
        $annonces = House::where('statut', 'Validé')->get();
        
        foreach ($routeCollection as $value) {
            $uri = $value->uri();

            if($uri == '/') {
                $sitemap->add(Url::create(config('app.url'))->setPriority(1.0));
            } 
            if(strpos($uri, 'user/showHouse/') !== false){
                foreach($annonces as $annonce){
                    $sitemap->add(Url::create(config('app.url') .'/'. str_replace($id, $annonce->id, $uri))->setPriority(1.0));
                }
            }
            if($uri == "cgu" || $uri == "cgv" || $uri == "apropos" || $uri == "politique_de_confidentialite" || $uri == "mentions_legales" 
            || $uri == "faq" || $uri == "houses"){
                $sitemap->add(Url::create(config('app.url').'/'. $uri)->setPriority(0.5));
            }
        }
        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}

