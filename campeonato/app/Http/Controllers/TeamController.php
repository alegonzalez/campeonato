<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Player;
use App\Championship;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use DB;
class TeamController extends Controller
{
  /**
  * Construct.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('auth');
  }
  /**
  * This function show the main page of teams
  *@param  Request $request,$key_share
  *@return view view/team/index.blade.php
  */
  public function index(Request $request){
    $id_championship = $request->get('id_championschip');
    $teams = [];
    $request_team = "";
    if(!empty($id_championship)){
      session(['id_champioship' => $id_championship]);
      $teams = Team::where('id_championships', session('id_champioship'))->paginate(6);
      $request_team = "active";
    }else if(!empty(session('id_champioship'))){
      $teams = Team::where('id_championships', session('id_champioship'))->paginate(6);
    }
    if (Auth::check()) {
      $championships = Championship::where('id_user', Auth::id())->get();
      return view('team.index',['championships' => $championships,'teams'=>$teams,'request_team' => $request_team]);
    }
  }

  /**
  * This function show page to create a new team
  * @return view team/create.blade.php
  */
  public function create(){
    $championships = Championship::where('id_user', Auth::id())->get();
    return view('team.create_edit',['championships' => $championships,'action' =>'create']);
  }
  /**
  * This function create and save a new team in database
  *@param Request $request
  * @return view team/create.blade.php
  */
  public function storage(Request $request){
    $this->validate_field($request);
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
      $team->id_user = Auth::id();
      $team->save();
      alert()->success('El equipo con el nombre de ' . $team->name . ' se ha creado con exito');
      return redirect('team/index');
    }
  }

  /**
  * This function show  page for  edit a specific team
  *@param $id_team the value is integer
  * @return view team/edit.blade.php
  */
  public function edit($id_team){
      $championships = Championship::where('id_user', Auth::id())->get();
      $team = DB::table('teams')
      ->join('championships', 'teams.id_championships', '=', 'championships.id')
      ->select('teams.*','championships.name as name_championship')
      ->where('teams.id', '=' , $id_team)
      ->get();
      return view('team.create_edit',["team"=>$team,'championships' => $championships,'action' =>'edit']);
  }
  /**
  * This function show  page for  edit a specific team
  *@param Request $request,$id
  * @return view team/edit.blade.php
  */
  public function update(Request $request,$id){
    $this->validate_field($request);
    if($request->isMethod('post')){
      $team = Team::find($id);
      if($request->hasFile('upload_photo')){
        if($team->path_image != ""){
          Storage::disk('public')->delete('teams/62qKUwR3y52ViSoYkmjV5o6PwXdqo0zyFdbVpuwA.png');
        }
        $path =  Storage::disk('public')->put('teams', $request->file('upload_photo'));
        $team->path_image = $path;
      }
      $team->name = $request->input('name_team');
      $team->id_championships = $request->input('id_championschip');
      $team->id_user = Auth::id();
      $team->save();
      return redirect('team/index/'. $team->id_championships);
    }else{
      alert()->warning('La acción que esta realizando no esta permitida.', '');
      return redirect('team/index');
    }
  }

  /**
  * This function delete a specific team
  * @return redirect with  route  team/index
  */
  public function destroy($id){
    $team = Team::find($id);
    $id_championship =  $team->id_championships;
    Storage::disk('public')->delete($team->path_image);
    $team->delete();
    return redirect('team/index/');
  }
  /**
  * This function decode id user, is used base64
  * @return id_user
  */
  public function get_id_decode($key_share){
    $result = explode("-",$key_share);
    return base64_decode($result[0]);
  }
  /**
  *This function validate all field from view
  *@param Request $request
  *@return validation
  */
  private function validate_field($request){
    return  $request->validate([
      'upload_photo' => 'image|mimes:jpeg,png,jpg|max:2048',
      'name_team' => 'required',
      'id_championschip' =>'required',
    ]);
  }
}
