<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    $user = new User;
    $user->name = "Alejandro Alvarado González";
    $user->email = "alegonzalez21195@gmail.com";
    $user->password = Hash::make("Ale21195");
    $user->save();
  }
}
