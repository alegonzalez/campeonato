<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Championship;
use Auth;
use DB;
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

    // return view('championship.create',['championship' => la]);
  }
  /**
  * This function create and save a new team in database
  * @return view team/create.blade.php
  */
  public function storage(Request $request){


  }

  /**
  * This function show  page for  edit a specific team
  * @return view team/edit.blade.php
  */
  public function edit($id_team){

    return view('team.edit',["team"=>Team::where('id', $id)->get()]);
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
