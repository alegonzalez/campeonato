<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeekdaysCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekdays_calendar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_day');
            $table->string("time_game");
            $table->foreignId('id_calendar');
            $table->foreign('id_day')->references('id')->on('weekdays')->onDelete('cascade');
            $table->foreign('id_calendar')->references('id')->on('calendars')->onDelete('cascade');
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
        Schema::dropIfExists('weekdays_calendar');
    }
}
