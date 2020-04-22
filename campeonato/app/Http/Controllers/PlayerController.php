<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\Team;
use App\Championship;
use App\Game_position;
use Auth;
use DB;

class PlayerController extends Controller
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
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return view('player.index');
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $championships = Championship::where('id_user',Auth::id())->get();
    $game_position = Game_position::find([1,2,3,4]);
    return view('player.create_edit',['action' => 'create','championships' => $championships,'game_position' => $game_position]);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $this->validate_field($request);
    if($request->isMethod('post')){
      $player = new Player;
      $player = $this->set_data_player($player,$request);
      $player->save();
      alert()->success('El jugador  ' .   $player->name . ' se ha creado con exito');
      return redirect('player/create');
    }
  }
  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $player = DB::table('players')
    ->join('game_positions', 'players.id_position_game', '=', 'game_positions.id')
    ->join('teams', 'players.id_team', '=', 'teams.id')
    ->select('players.*', 'game_positions.name as name_position','teams.name as name_team')
    ->where('players.id','=',$id)
    ->get();
    $championships = Championship::where('id_user',Auth::id())->get();
    $team = Team::where('id',$player[0]->id_team)->get();
    $teams = Team::where('id_user',Auth::id())->get();
    $game_position = Game_position::find([1,2,3,4]);
    return view('player.create_edit',['action' => 'edit','player' => $player,'championships' =>$championships,'team' =>$team,'game_position' => $game_position,'teams' => $teams]);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $this->validate_field($request);
    if($request->isMethod('post')){
      $player = Player::find($id);
      $player = $this->set_data_player($player,$request);
      $player->save();
      alert()->success('El jugador  ' .   $player->name . ' se actualizó con exito');
      return redirect('player/index ');
    }
  }
  /**
  *This function set all data to object player
  *@param App/Player $player, Request $request
  *@return $player
  */
  function set_data_player($player,$request){
    $player->name = $request->input('player_name') ;
    $player->shirt_number = ($request->input('shirt_number') == null) ? -1 : $request->input('shirt_number');
    $player->id_position_game = $request->input('position');
    $player->goals = $request->input('goals');
    $player->id_team = $request->input('id_team');
    return $player;
  }
  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $player = Player::find($id);
    if($player->delete()){
      return response()->json(['status' => '200']);
    }else{
      return response()->json(['status' => 'error']);
    }
  }

  /**
  *This function get players searched by user
  *@param Request $request
  *@return json with player result
  */
  public function get_player(Request $request){
    $array_id_team  = [];
    $cont = 0;
    $players = "";
    $teams = Team::where([
      ['id_user','=',Auth::id()],
      ['name','like', '%' . $request->team . '%'],
      ])->get();
      foreach ($teams as $team) {
        $array_id_team[$cont] =  $team->id;
        $cont++;
      }
      if(count($array_id_team) > 0){
        $players = DB::table('players')
        ->join('game_positions', 'players.id_position_game', '=', 'game_positions.id')
        ->select('players.*', 'game_positions.name as name_position')
        ->where('id_team','=',[$array_id_team])
        ->get();
      }

      return response()->json(['teams' => $teams,'players' => $players]);
    }
    /**
    *This function get all team by id_championship
    *@param $id_championship
    *@return json with teams player
    */
    public function get_teams($id_championship){
      $teams = Team::where('id_championships',$id_championship)->get();
      $message = (count($teams) == 0) ? 'Nothing' : '' ;
      return response()->json(['teams' => $teams,'message' => $message]);
    }
    /**
    *This function validate all field from view
    *@param Request $request
    *@return validation
    */
    private function validate_field($request){
      return  $request->validate([
        'id_championschip' => 'required',
        'id_team' => 'required',
        'player_name' => 'required',
        'position' => 'required',
        'goals' =>'numeric',
      ]);
    }
  }
