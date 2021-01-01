<?php

use Illuminate\Database\Seeder;

class HousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $houses = [
            [
                'title' => 'Cabane de trappeur',
                'user_id' => 1,
                'category_id' => 2,
                'adresse' => 'Gironde, France',
                'description' => "Vous vous demandez comment vous mettre dans la peau d’un chasseur, en pleine forêt du Québec / Canada ou des Etats-Unis ? Pas besoin de réserver votre billet d’avion. C’est possible en Gironde, près de Bordeaux !
                Notre domaine d’hébergement insolite peut en effet vous transporter instantanément vers le continent nord-américain. Il vous suffit pour cela de vous installer confortablement dans notre magnifique cabane de trappeur. Si vous êtes séduit par son look « rustique », vous le serez tout autant par son intérieur, dont le niveau de confort vous permet d’y séjourner en toutes saisons.",
                'start_date' => '2021-01-01',
                'end_date' => '2021-12-30',
                'nb_personnes' => 4,
                'phone' => '0623216792',
                'price' => 99.00,
                'photo' => 'cabane_trappeur.jpg',
                'statut' => 'Validé',
                'disponible' => 'oui'
            ],
            [
                'title' => 'La yourte du vigneau',
                'user_id' => 1,
                'category_id' => 4,
                'adresse' => 'Vendée, France',
                'description' => "Yourte Mongole en plein cœur du domaine à l'abri des regards
                Vous pourrez profiter d'un séjour en famille dans cette yourte typique de la culture mongole, avec puits de lumière. Calme et tranquillité seront les maîtres mots de votre séjour.
                Cet habitat traditionnel des populations nomades de Mongolie a plus de mille ans d’histoire. De génération en génération, de transhumance en transhumance elle accompagne le peuple mongol, en harmonie avec la nature. Elle est aujourd'hui toujours utilisée.
                
                Tranquillité garantie, aucun vis à vis autour de la yourte
                De nombreuses ballades sont possibles dès l’emplacement, et entre autres le long de la vallée de l’Yon (vallée de Piquet).
                La yourte traditionnelle en bois, écologique, tout le charme de l’authenticité en Vendée pour satisfaire votre envie d'évasion et de nature.
                La yourte est composée d'une armature de bois recouverte de plusieurs couches textiles : feutre isolant, toile imperméable, toile de parement. Ses murs verticaux et son espace circulaire en font un lieu agréable à vivre et relativement grand.",
                'start_date' => '2021-01-01',
                'end_date' => '2021-12-30',
                'nb_personnes' => 4,
                'phone' => '0623216792',
                'price' => 84.00,
                'photo' => 'yourte_vigneau.jpg',
                'statut' => 'Validé',
                'disponible' => 'oui'
            ],
            [
                'title' => 'La yourte du domaine du chatelet',
                'user_id' => 1,
                'category_id' => 4,
                'adresse' => 'Vosges, France',
                'description' => "C’est une véritable yourte mongole traditionnelle de qualité supérieure (adaptée aux climats des Hautes Vosges) aménagée de ces meubles d’origine, elle peut accueillie jusqu’à 5 personnes

                Venez goûter au confort de cet habitat nomade aux portes du parc naturel régional des Ballons des Vosges dans un cadre naturel, calme et romantique. Pour votre confort, la Yourte est alimentée en eau froide ( hors période de gèle) et en électricité et dispose d'un chauffage au bois. Elle est équipée à l’intérieur de 5 couchages, (1 lit 2 places, 2 lits 1 place et un lit d'appoint), une table basse avec tabourets, frigo, vaisselle, bouilloire électrique et four micro-onde.
                
                A l’extérieur de la Yourte, sur la terrasse panoramique, un espace sanitaire avec eau froide (hors période de gèle), toilette sèche, table pique-nique, parasol, transats et un barbecue en pierre au pied de la terrasse.
                
                Un espace sanitaire collectif avec douches, WC, et espace plonge est à votre disposition à 80 m de la Yourte.
                
                Il n'est possible de cuisiner à l’intérieur de la Yourte mais vous avez la possibilité de faire un barbecue ou commander des plats préparés chez l'un de nos traiteur partenaire ou faire de la restauration.",
                'start_date' => '2021-01-01',
                'end_date' => '2021-12-30',
                'nb_personnes' => 2,
                'phone' => '0623216792',
                'price' => 70.00,
                'photo' => 'yourte_vosges.jpg',
                'statut' => 'Validé',
                'disponible' => 'oui'
            ],
            [
                'title' => "Village d'Igloos du Semnoz",
                'user_id' => 1,
                'category_id' => 3,
                'adresse' => 'Crêt de Chatillon Leschaux 74000 Annecy, France',
                'description' => "Expérience 4 saisons au cœur du Parc Naturel régional des Bauges, face au Mont-Blanc.

                L'hiver, pour changer un peu du ski et vivre une expérience au plus près de Dame Nature, nous avons rendez-vous au Semnoz à 1700m d'altitude dans un village d'igloos. A côté des traditionnels igloos de neige sont installés des alti-dômes pour du bivouac toute saison.
                
                Ainsi les plus frileux ont aussi droit à leur nuit en pleine nature, même au cœur de l'hiver ! Mais pour eux, ce sera sous un alti-dôme, un igloo de bois et de toile au toit panoramique, où le confort est assuré par un poêle à bois. Un intérieur cosy, chaleureux, une structure 100% recyclable et autonome en énergie, on ne pouvait rêver mieux.
                On rejoint dômes et igloos de l'Eco-Bivouac Village d'Igloos en raquettes à la lueur des flambeaux, marchant dans les traces du guide qui nous ouvre la voie. Sur place, on fait connaissance avec ses voisins d'un soir autour du bar en neige et sous un alti-dôme géant (49 m2, autonome en énergie, sans apport d’électricité ni d’eau) on partage les bons plats de terroir d'un restaurateur voisin et une soirée tout à aussi unique. Vient enfin le moment tant attendu de prendre possession de son véritable igloo ou de son alti-dôme pour la nuit !",
                'start_date' => '2021-01-01',
                'end_date' => '2021-12-30',
                'nb_personnes' => 16,
                'phone' => '+33 6 99 88 74 74',
                'price' => 150.00,
                'photo' => 'igloo_demo.jpg',
                'statut' => 'Validé',
                'disponible' => 'oui'
            ],
            
            
        ];
        DB::table('houses')->insert($houses);
    }
}
