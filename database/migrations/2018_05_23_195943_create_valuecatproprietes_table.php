<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValuecatproprietesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valuecatproprietes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->integer('propriete_id');
            $table->integer('house_id');
            $table->integer('reservation_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('valuecatproprietes');
    }
}
