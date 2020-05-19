<?php

use Illuminate\Database\Seeder;
use App\Team;
class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data = [];
      $data[0] = ['name' => 'SPA','path_image' => '','id_championships' =>1,'id_user' => 1];
      $data[1] = ['name' => 'Financiero','path_image' => '','id_championships' =>1,'id_user' => 1];
      $data[2] = ['name' => 'Recepción Hotel','path_image' => '','id_championships' =>1,'id_user' => 1];
      $data[3] = ['name' => 'Mantenimiento','path_image' => '','id_championships' =>1,'id_user' => 1];
      $data[4] = ['name' => 'Housekeeping','path_image' => '','id_championships' =>1,'id_user' => 1];
      $data[5] = ['name' => 'Lavanderia','path_image' => '','id_championships' =>1,'id_user' => 1];
      $data[6] = ['name' => 'Salon','path_image' => '','id_championships' =>1,'id_user' => 1];
      $data[7] = ['name' => 'Seguridad','path_image' => '','id_championships' =>1,'id_user' => 1];
      for ($i=0; $i < count($data); $i++) {
        $team = Team::create($data[$i]);
        $team->save();
      }
    }
}
