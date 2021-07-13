<?php

use Illuminate\Database\Seeder;

class ProprietesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $proprietes = [
            [
                'propriete' => 'wifi',
                'statut' => 1,
                'category_id' => 1
            ],
            [
                'propriete' => 'wifi',
                'statut' => 1,
                'category_id' => 2
            ],
            [
                'propriete' => 'wifi',
                'statut' => 1,
                'category_id' => 3
            ],
            [
                'propriete' => 'wifi',
                'statut' => 1,
                'category_id' => 4
            ],
            [
                'propriete' => 'wifi',
                'statut' => 1,
                'category_id' => 5
            ],
            [
                'propriete' => 'wifi',
                'statut' => 1,
                'category_id' => 6
            ],
            [
                'propriete' => 'chauffage',
                'statut' => 1,
                'category_id' => 1
            ],
            [
                'propriete' => 'chauffage',
                'statut' => 1,
                'category_id' => 2
            ],
            [
                'propriete' => 'chauffage',
                'statut' => 1,
                'category_id' => 3
            ],
            [
                'propriete' => 'chauffage',
                'statut' => 1,
                'category_id' => 4
            ],
            [
                'propriete' => 'chauffage',
                'statut' => 1,
                'category_id' => 5
            ],
            [
                'propriete' => 'chauffage',
                'statut' => 1,
                'category_id' => 6
            ]
        ];
        DB::table('proprietes')->insert($proprietes);
    }
}
