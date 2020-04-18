<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position_tables', function (Blueprint $table) {
            $table->id();
            $table->integer("points");
            $table->integer("game_played");
            $table->integer("goals_scored");
            $table->integer("goals_against");
            $table->integer("performance");
            $table->foreignId('id_championships');
            $table->foreign('id_championships')->references('id')->on('championships')->onDelete('cascade');;
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
        Schema::dropIfExists('position_tables');
    }
}
