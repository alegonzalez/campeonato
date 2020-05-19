<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position_table;
use App\Championship;
use App\Team;
use App\User;
use Auth;
use DB;
class TableController extends Controller
{
  /**
  * Display a listing of championship.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $championship = Championship::where('id_user',Auth::id())->get();
    return view('table.index',['championships' => $championship]);
  }

  /**
  * create all Position table of each position table
  *@param $id_championships
  * @return void
  */
  public function create($id_teams,$id_championship,$table)
  {
    $entry = 0;
    foreach ($id_teams as $team) {
      foreach ($table as $key) {
        if($key['id_team'] == $team->id){
          $entry = 1;
        }
      }
      if($entry != 1){
        $entry = 0;
        $table = new Position_table;
        $table->points = 0;
        $table->played_matches = 0;
        $table->won_matches = 0;
        $table->tied_matches = 0;
        $table->lost_matches = 0;
        $table->goals_scored = 0;
        $table->goals_against = 0;
        $table->performance = 1.00;
        $table->id_championships = $id_championship;
        $table->id_team = $team->id;
        $table->save();
      }else{
        $entry = 0;
      }
    }
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id_championship,$key =null)
  {
    if(Auth::check()){
      $table = Position_table::select('id_team')->where('id_championships',$id_championship)->get();
      $id_teams = Team::select('id')->where('id_championships',$id_championship)->get();
      if(count($table) < count($id_teams)){
        $this->create($id_teams,$id_championship,$table);
      }
      $table = $this->get_all_table_championship($id_championship);
      return view('table.show',['table'=> $table]);
    }else{
      if($key != null){
        $user = User::where('share_key',$key)->get();
        if(count($user) == 0){
          return redirect('home') ;
        }else{
          $table = $this->get_all_table_championship($id_championship);
          return view('table.show',['table'=> $table]);
        }
      }else{
        return redirect('home');
      }
    }
  }
  /**
  *This function get all table of specified championship
  *@param $id_championship
  *@return $table
  */
  private function get_all_table_championship($id_championship){
    $table = DB::table('position_tables')
    ->join('teams', 'position_tables.id_team', '=', 'teams.id')
    ->select('position_tables.*','teams.name as team_name')
    ->where('position_tables.id_championships','=',$id_championship)
    ->paginate(15);
    return $table;
  }
  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $table = DB::table('position_tables')
    ->join('teams', 'position_tables.id_team', '=', 'teams.id')
    ->select('position_tables.*','teams.name as team_name')
    ->where('position_tables.id','=',$id)
    ->get();
    return view('table.edit',['table'=> $table]);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id_table)
  {
    if($request->isMethod('post')){
      $won_match = (int)$request->input('won_match');
      $tied_matches = (int)$request->input('tied_matches');
      $table = Position_table::find($id_table);
      $table->points = ($won_match * 3) + $tied_matches;
      $table->played_matches = $won_match  + $tied_matches + (int)$request->input('lose_match');
      $table->won_matches = $won_match;
      $table->tied_matches = $tied_matches;
      $table->lost_matches = (int)$request->input('lose_match');
      $table->goals_scored = (int)$request->input('goals_scored');
      $table->goals_against = (int)$request->input('goals_against');
      $table->performance =$this->get_performance($table->played_matches,$table->won_matches,$table->tied_matches);
      $table->save();
      return redirect('table/show/'.$table->id_championships);
    }else{
      return redirect('home');
    }


  }
  /**
  *This function get perdormance of teams
  */
  private function get_performance($played_matches,$won_matches,$tied_matches){
    $percent_won_matches =  $won_matches / $played_matches;
    $percent_tied_matches =  $tied_matches / $played_matches;
    return $percent_won_matches + $percent_tied_matches;
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }
}
