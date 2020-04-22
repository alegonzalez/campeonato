<?php
use Illuminate\Database\Seeder;
use App\Game_position;
class Game_position_seeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      Game_position::create(array('name' => 'Portero'));
      Game_position::create(array('name' => 'Defensa'));
      Game_position::create(array('name' => 'Mediocampista'));
      Game_position::create(array('name' => 'Delentero'));
    }
}
