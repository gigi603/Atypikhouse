<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'category' => 'Tous',
                'statut' => 1
            ],
            [
                'category' => 'Cabane',
                'statut' => 1
            ],
            [
                'category' => 'Igloo',
                'statut' => 1
            ],
            [
                'category' => 'Yourte',
                'statut' => 1
            ],
        ];
        DB::table('categories')->insert($categories);
    }
}
