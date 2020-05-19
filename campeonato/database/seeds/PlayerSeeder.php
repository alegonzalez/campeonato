<?php

use Illuminate\Database\Seeder;
use App\Player;
class PlayerSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    $data = [];
    //spa
    $data[0] = ['name' => 'Randall Huertas','shirt_number' => '9','goals' =>0,'id_team' => 1,'id_position_game' => 2];
    $data[1] = ['name' => 'Randall Badilla','shirt_number' => '10','goals' =>0,'id_team' => 1,'id_position_game' => 4];
    $data[2] = ['name' => 'Sergio Duarte','shirt_number' => '11','goals' =>0,'id_team' => 1,'id_position_game' => 3];
    $data[3] = ['name' => 'JOse Angel','shirt_number' => '12','goals' =>0,'id_team' => 1,'id_position_game' => 4];
    $data[4] = ['name' => 'Eliberto','shirt_number' => '13','goals' =>0,'id_team' => 1,'id_position_game' => 1];
    $data[5] = ['name' => 'Eli roberto ','shirt_number' => '14','goals' =>0,'id_team' => 1,'id_position_game' => 2];
    $data[6] = ['name' => 'Josue Tenorio','shirt_number' => '8','goals' =>0,'id_team' => 1,'id_position_game' => 3];
    $data[7] = ['name' => 'Andersor Perez','shirt_number' => '22','goals' =>0,'id_team' => 1,'id_position_game' => 2];
//financiero
    $data[8] = ['name' => 'Alejandro Alvarado','shirt_number' => '10','goals' =>0,'id_team' => 2,'id_position_game' => 4];
    $data[9] = ['name' => 'Jonny Vega','shirt_number' => '12','goals' =>0,'id_team' => 2,'id_position_game' => 3];
    $data[10] = ['name' => 'Pedro Corella','shirt_number' => '4','goals' =>0,'id_team' => 2,'id_position_game' => 2];
    $data[11] = ['name' => 'Allan Rodriguez','shirt_number' => '15','goals' =>0,'id_team' => 2,'id_position_game' => 4];
    $data[12] = ['name' => 'Eduardo Pacheco','shirt_number' => '30','goals' =>0,'id_team' => 2,'id_position_game' => 2];
    $data[13] = ['name' => 'Oldemar Arrieta ','shirt_number' => '1','goals' =>0,'id_team' => 2,'id_position_game' => 1];
    $data[14] = ['name' => 'Jeudy','shirt_number' => '4','goals' =>0,'id_team' => 2,'id_position_game' => 2];
    $data[15] = ['name' => 'Esteban Vargas','shirt_number' => '20','goals' =>0,'id_team' => 2,'id_position_game' => 3];
//Recepcion hotel
    $data[16] = ['name' => 'Douglas Mora','shirt_number' => '5','goals' =>0,'id_team' => 3,'id_position_game' => 2];
    $data[17] = ['name' => 'Gerald Guerrero','shirt_number' => '4','goals' =>0,'id_team' => 3,'id_position_game' => 2];
    $data[18] = ['name' => 'Anderson Herrera','shirt_number' => '8','goals' =>0,'id_team' => 3,'id_position_game' => 3];
    $data[19] = ['name' => 'Brandon Rivera','shirt_number' => '11','goals' =>0,'id_team' => 3,'id_position_game' => 4];
    $data[20] = ['name' => 'Carlos Salas','shirt_number' => '10','goals' =>0,'id_team' => 3,'id_position_game' => 4];
    $data[21] = ['name' => 'Froylan Ledezma','shirt_number' => '1','goals' =>0,'id_team' => 3,'id_position_game' => 1];
    $data[22] = ['name' => 'Tony Mendez','shirt_number' => '7','goals' =>0,'id_team' => 3,'id_position_game' => 3];
    $data[23] = ['name' => 'Steven Elizondo','shirt_number' => '15','goals' =>0,'id_team' => 3,'id_position_game' => 2];
    //Mantenimiento
    $data[24] = ['name' => 'Brandon Jimenez','shirt_number' => '10','goals' =>0,'id_team' => 4,'id_position_game' => 4];
    $data[25] = ['name' => 'Luis Garcia','shirt_number' => '8','goals' =>0,'id_team' => 4,'id_position_game' => 3];
    $data[26] = ['name' => 'Steven jara','shirt_number' => '7','goals' =>0,'id_team' => 4,'id_position_game' => 4];
    $data[27] = ['name' => 'Ernesto vargas','shirt_number' => '11','goals' =>0,'id_team' => 4,'id_position_game' => 3];
    $data[28] = ['name' => 'Lucas Alvarez','shirt_number' => '4','goals' =>0,'id_team' => 4,'id_position_game' => 2];
    $data[29] = ['name' => 'Pedro tenorio','shirt_number' => '1','goals' =>0,'id_team' => 4,'id_position_game' => 1];
    $data[30] = ['name' => 'Carlos salazar','shirt_number' => '3','goals' =>0,'id_team' => 4,'id_position_game' => 2];
    $data[31] = ['name' => 'Marvin obando','shirt_number' => '9','goals' =>0,'id_team' => 4,'id_position_game' => 2];
    for ($i=0; $i < count($data); $i++) {
      $team = Player::create($data[$i]);
      $team->save();
    }
    $data = [];
    //Housekeeping
    $data[0] = ['name' => 'Melvin aragon','shirt_number' => '6','goals' =>0,'id_team' => 5,'id_position_game' => 2];
    $data[1] = ['name' => 'Andres acuña','shirt_number' => '14','goals' =>0,'id_team' => 5,'id_position_game' => 2];
    $data[2] = ['name' => 'Acevedo Manríquez Maro','shirt_number' => '12','goals' =>0,'id_team' => 5,'id_position_game' => 3];
    $data[3] = ['name' => 'Enrique Acevedo','shirt_number' => '11','goals' =>0,'id_team' => 5,'id_position_game' => 3];
    $data[4] = ['name' => 'José Acosta Gámez','shirt_number' => '10','goals' =>0,'id_team' => 5,'id_position_game' => 4];
    $data[5] = ['name' => 'Gerardo Aleman','shirt_number' => '9','goals' =>0,'id_team' => 5,'id_position_game' => 4];
    $data[6] = ['name' => 'Jason Navarro','shirt_number' => '1','goals' =>0,'id_team' => 5,'id_position_game' => 1];
    $data[7] = ['name' => 'Raul Angulo','shirt_number' => '5','goals' =>0,'id_team' => 5,'id_position_game' => 2];
    //Lavanderia
    $data[8] = ['name' => 'García Hernández José','shirt_number' => '6','goals' =>0,'id_team' => 6,'id_position_game' => 2];
    $data[9] = ['name' => 'García García José Luis ','shirt_number' => '14','goals' =>0,'id_team' => 6,'id_position_game' => 2];
    $data[10] = ['name' => ' Hernández Hernández Francisco ','shirt_number' => '12','goals' =>0,'id_team' => 6,'id_position_game' => 3];
    $data[11] = ['name' => 'García García Pedro ','shirt_number' => '11','goals' =>0,'id_team' => 6,'id_position_game' => 3];
    $data[12] = ['name' => 'DELGADO SARMIENTO ANGEL DAVID','shirt_number' => '10','goals' =>0,'id_team' => 6,'id_position_game' => 4];
    $data[13] = ['name' => 'Jacob Alpizar','shirt_number' => '9','goals' =>0,'id_team' => 6,'id_position_game' => 4];
    $data[14] = ['name' => 'Delgado Barrón Luis Felipe','shirt_number' => '1','goals' =>0,'id_team' => 6,'id_position_game' => 1];
    $data[15] = ['name' => 'Gómez Vargas Ignacio','shirt_number' => '5','goals' =>0,'id_team' => 6,'id_position_game' => 2];
    //Salon
    $data[16] = ['name' => 'González Trejo Daniel','shirt_number' => '6','goals' =>0,'id_team' => 7,'id_position_game' => 2];
    $data[17] = ['name' => 'Guerrero Padrés Alejandro','shirt_number' => '14','goals' =>0,'id_team' => 7,'id_position_game' => 2];
    $data[18] = ['name' => 'Hernández Prado Miguel','shirt_number' => '12','goals' =>0,'id_team' => 7,'id_position_game' => 3];
    $data[19] = ['name' => 'Herrera Arias Luis Fernando','shirt_number' => '11','goals' =>0,'id_team' => 7,'id_position_game' => 3];
    $data[20] = ['name' => 'Meré Hidalgo Pablo','shirt_number' => '10','goals' =>0,'id_team' => 7,'id_position_game' => 4];
    $data[21] = ['name' => 'Torres Rojas Daniel','shirt_number' => '9','goals' =>0,'id_team' => 7,'id_position_game' => 4];
    $data[22] = ['name' => 'Zamora Peinado Emanuel','shirt_number' => '1','goals' =>0,'id_team' => 7,'id_position_game' => 1];
    $data[23] = ['name' => 'Ruiz vasquez Sergio','shirt_number' => '5','goals' =>0,'id_team' => 7,'id_position_game' => 2];
    //Seguridad
    $data[24] = ['name' => 'Mauricio Castro','shirt_number' => '6','goals' =>0,'id_team' => 8,'id_position_game' => 2];
    $data[25] = ['name' => 'Jafet Miranda','shirt_number' => '14','goals' =>0,'id_team' => 8,'id_position_game' => 2];
    $data[26] = ['name' => 'Luis Garita','shirt_number' => '12','goals' =>0,'id_team' => 8,'id_position_game' => 3];
    $data[27] = ['name' => 'Ortega Romero Josue','shirt_number' => '11','goals' =>0,'id_team' => 8,'id_position_game' => 3];
    $data[28] = ['name' => 'Arias Pilarte Rafael','shirt_number' => '10','goals' =>0,'id_team' => 8,'id_position_game' => 4];
    $data[29] = ['name' => 'Arroyo Keilor','shirt_number' => '9','goals' =>0,'id_team' => 8,'id_position_game' => 4];
    $data[30] = ['name' => 'Martinez Juan Pablo','shirt_number' => '1','goals' =>0,'id_team' => 8,'id_position_game' => 1];
    $data[31] = ['name' => 'Fabian Jara','shirt_number' => '5','goals' =>0,'id_team' => 8,'id_position_game' => 2];
    for ($i=0; $i < count($data); $i++) {
      $team = Player::create($data[$i]);
      $team->save();
    }
  }


}
