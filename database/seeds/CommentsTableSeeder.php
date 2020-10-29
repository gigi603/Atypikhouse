<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = [
            [
                'comment' => "C'était une expérience agréable",
                'note' => 3,
                'user_id' => 1,
                'admin_id' => 0,
                'house_id' => 1,
                'parent_id' => NULL
            ],
            [
                'comment' => "Merci pour votre réservation",
                'note' => 4,
                'user_id' => 1,
                'admin_id' => 0,
                'house_id' => 1,
                'parent_id' => NULL
            ]
        ];
        DB::table('comments')->insert($comments);
    }
}
