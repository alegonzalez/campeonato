<?php

use Illuminate\Database\Seeder;
use App\Championship;
class ChampionschipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $championship = new Championship;
        $championship->name = "Tabacon-Masculino";
        $championship->start_championship = "2020-04-30";
        $championship->id_user = 1;
        $championship->save();
    }
}
