<?php

use Illuminate\Database\Seeder;

class valuecatproprietesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $valuecatproprietes = [
            
        ];
        DB::table('valuecatproprietes')->insert($valuecatproprietes);
    }
}
