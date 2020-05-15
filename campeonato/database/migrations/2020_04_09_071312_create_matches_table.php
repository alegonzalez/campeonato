<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('matches', function (Blueprint $table) {
      $table->id();
      $table->foreignId('team_one');
      $table->foreignId('team_two');
      $table->foreignId('id_calendar');
      $table->foreign('id_calendar')->references('id')->on('calendars')->onDelete('cascade');
      $table->foreign('team_one')->references('id')->on('teams')->onDelete('cascade');
      $table->foreign('team_two')->references('id')->on('teams')->onDelete('cascade');
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
    Schema::dropIfExists('matches');
  }
}
