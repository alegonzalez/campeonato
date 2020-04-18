<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breaches', function (Blueprint $table) {
            $table->id();
            $table->string("player_name",100);
            $table->integer("yellow_card");
            $table->integer("red_card");
            $table->foreignId('id_player');
            $table->foreign('id_player')->references('id')->on('players')->onDelete('cascade');;
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
        Schema::dropIfExists('breaches');
    }
}
