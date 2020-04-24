<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->date("date_game");
            $table->time("time_game");
            $table->boolean('round_trip_match');
            $table->foreignId('team_one');
            $table->foreignId('team_two');
            $table->foreignId('id_championships');
            $table->foreign('team_one')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('team_two')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::dropIfExists('calendars');
    }
}
