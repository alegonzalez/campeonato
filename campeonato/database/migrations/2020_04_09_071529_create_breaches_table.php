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
            $table->integer("yellow_card");
            $table->integer("red_card");
            $table->foreignId('id_player');
            $table->foreign('id_player')->references('id')->on('players')->onDelete('cascade');
            $table->foreignId('id_championships');
            $table->foreign('id_championships')->references('id')->on('championships')->onDelete('cascade');
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
