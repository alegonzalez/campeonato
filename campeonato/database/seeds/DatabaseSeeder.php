<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
  * Seed the application's database.
  *
  * @return void
  */
  public function run()
  {
    $this->call(Game_position_seeder::class);
    $this->call(UserSeeder::class);
    $this->call(ChampionschipSeeder::class);
    $this->call(TeamSeeder::class);
    $this->call(PlayerSeeder::class);
    $this->call(WeekdaySeeder::class);
  }
}
