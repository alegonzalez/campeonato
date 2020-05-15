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
            $table->string("time_game");
            $table->boolean('round_trip_match');
            $table->foreignId('id_day');
            $table->foreignId('id_championships');
            $table->foreign('id_day')->references('id')->on('weekdays')->onDelete('cascade');
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
