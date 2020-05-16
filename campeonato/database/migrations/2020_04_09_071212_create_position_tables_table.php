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
            $table->integer("played_matches");
            $table->integer("won_matches");
            $table->integer("tied_matches");
            $table->integer("lost_matches");
            $table->integer("goals_scored");
            $table->integer("goals_against");
            $table->float("performance",3,3);
            $table->foreignId('id_championships');
            $table->foreignId('id_team');
            $table->foreign('id_championships')->references('id')->on('championships')->onDelete('cascade');
            $table->foreign('id_team')->references('id')->on('teams')->onDelete('cascade');
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
