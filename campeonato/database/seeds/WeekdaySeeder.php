<?php

use Illuminate\Database\Seeder;
use App\Weekday;
class WeekdaySeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    $data = [];
    $data[0] = ['day' => 'Lunes'];
    $data[1] = ['day' => 'Martes'];
    $data[2] = ['day' => 'Miércoles'];
    $data[3] = ['day' => 'Jueves'];
    $data[4] = ['day' => 'Viernes'];
    $data[5] = ['day' => 'Sábado'];
    $data[6] = ['day' => 'Domingo'];
    for ($i=0; $i < count($data); $i++) {
      $team = Weekday::create($data[$i]);
      $team->save();
    }
  }
}
