<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Championship;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
  /**
  * This function show the main page of teams
  */
  public function index(Request $request,$key_share = null){
    $id_championship = $request->get('id_championschip');
    $teams = [];
    if(!empty($id_championship)){
      session(['id_champioship' => $id_championship]);
      $teams = Team::where('id_championships', session('id_champioship'))->paginate(6);
    }else if(!empty(session('id_champioship'))){
      $teams = Team::where('id_championships', session('id_champioship'))->paginate(6);
    }
    if (Auth::check()) {
      $championships = Championship::where('id_user', Auth::id())->get();
      return view('team.index',['championships' => $championships,'teams'=>$teams]);
    }else{
      $id_user_decode = $this->get_id_decode($key_share);
      $championships = Championship::where('id_user', $id_user_decode)->get();
      return view('team.index',['championships' => $championships,'key_share' =>$key_share,'teams'=>$teams ]);
    }
  }

  /**
  * This function show page to create a new team
  * @return view team/create.blade.php
  */
  public function create(){
    if(Auth::check()){
      $championships = Championship::where('id_user', Auth::id())->get();
      return view('team.create',['championships' => $championships]);
    }else{
      alert()->warning('No tienes acceso para realizar esta acción.', 'Acceso denegado');
      return redirect('home');
    }
  }
  /**
  * This function create and save a new team in database
  *@param Request $request
  * @return view team/create.blade.php
  */
  public function storage(Request $request){
    $validate_data = $request->validate([
      'upload_photo' => 'image|mimes:jpeg,png,jpg|max:2048',
      'name_team' => 'required',
      'id_championschip' =>'required',
    ]);
    if($request->isMethod('post')){
      $team = new Team;
      if($request->hasFile('upload_photo')){
        $path =  Storage::disk('public')->put('teams', $request->file('upload_photo'));
        $team->path_image = $path;
      }else{
        $team->path_image = "";
      }
      $team->name = $request->input('name_team');
      $team->id_championships = $request->input('id_championschip');
      $team->save();
      alert()->success('El equipo con el nombre de ' . $team->name . ' se ha creado con exito');
      return redirect()->route('team/index');
    }
  }

  /**
  * This function show  page for  edit a specific team
  *@param $id_team the value is integer
  * @return view team/edit.blade.php
  */
  public function edit($id_team){
    return view('team.edit',["team"=>Team::where('id', $id_team)->get()]);
  }
  /**
  * This function show  page for  edit a specific team
  * @return view team/edit.blade.php
  */
  public function update(Request $request){


  }

  /**
  * This function delete a specific team
  * @return redirect with  route  team/index
  */
  public function destroy($id){

  }
  /**
  * This function decode id user, is used base64
  * @return id_user
  */
  public function get_id_decode($key_share){
    $result = explode("-",$key_share);
    return base64_decode($result[0]);
  }

}
