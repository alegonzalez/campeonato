<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\breach;
use App\Team;
use App\Player;
use App\Championship;
use App\Position_table;
use Auth;
use DB;
class BreachController extends Controller
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
    $championships = Championship::where('id_user',Auth::id())->get();
    return view('breach.index',['championships' => $championships]);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create($id_championship)
  {
    $teams = Team::where('id_championships',$id_championship)->get();
    $players = DB::table('players')
    ->join('teams', 'players.id_team', '=', 'teams.id')
    ->select('players.name','players.id')
    ->where('teams.id_championships','=',$id_championship)
    ->get();
    return view('breach.create',['teams' => $teams,'id_championship' => $id_championship]);
  }
  public function get_list_players($id_team){
    $players = Player::where('id_team',$id_team)->get();
    $mathes_played = Position_table::select('played_matches')->where('id_team',$id_team)->get();
    return response()->json([
      'players' => $players,
      'matches_played' => $mathes_played]);
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
      if($request->isMethod('post')){
        $breach = new breach;
        $id_championship = $request->input('id_championship');
        return ($this->set_new_breach($breach,$request)) ? redirect('breach/show/' . $id_championship) : redirect('breach/create/' . $id_championship);
      }else{
        return redirect('home');
      }
    }
    /**
    * This function insert in database a new breach
    *@param breach $breach,Request $request
    *@return boolean
    */
    private function set_new_breach($breach,$request){
      $breach->yellow_card =(int)$request->input('yellow_card');
      $breach->red_card =(int)$request->input('red_card');
      $breach->id_player =$request->input('id_player');
      $breach->id_championships = $request->input('id_championship');
      return ($breach->save()) ? true : false;
    }
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id_championship)
    {
      $breaches =  DB::table('breaches')
      ->join('players', 'breaches.id_player', '=', 'players.id')
      ->select('breaches.*','players.name')
      ->where('breaches.id_championships','=',$id_championship)
      ->get();
      return view('breach.show',['breaches' => $breaches,'id_championship' => $id_championship]);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
      $breach = DB::table('breaches')
      ->join('players','breaches.id_player', '=', 'players.id')
      ->join('teams','players.id_team', '=', 'teams.id')
      ->join('position_tables','teams.id', '=', 'position_tables.id_team')
      ->select('players.name as player_name','teams.name as team_name','teams.id as id_team','breaches.*','position_tables.played_matches')
      ->where('breaches.id','=',$id)
      ->get();
      $teams = Team::where('id_championships',$breach[0]->id_championships)->get();
      $players = Player::where('id_team',$breach[0]->id_team)->get();
      return view('breach.edit',['breach' => $breach,'teams' => $teams,'players' => $players]);
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
      $breach = breach::find($id);
      $id_championship = $request->input('id_championship');
      return ($this->set_new_breach($breach,$request)) ? redirect('breach/show/' . $id_championship) : redirect('breach/edit/' . $id);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
      $player_name =DB::table('breaches')
      ->join('players','breaches.id_player','=','players.id')
      ->select('players.name')
      ->where('breaches.id','=',$id)
      ->get();
      $breach = breach::find($id);
      if($breach->delete()){
        alert()->success(' Los datos indiciplinarios del jugador  ' . $player_name[0]->name. ' se han eliminado correctamente.');
      }else{
        alert()->warning(' Los datos indiciplinarios del jugador  ' . $player_name[0]->name . ' no se han podido eliminar correctamente. ', '');
      }
      return redirect('breach/show/' . $breach->id_championships);
    }
  }
