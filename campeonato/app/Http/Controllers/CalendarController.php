<?php

namespace App\Http\Controllers;
use App\Championship;
use App\Calendar;
use App\Team;
use App\Weekday;
use App\Match;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
class CalendarController extends Controller
{
  /**
  * Display all championships.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $calendar = [];
    if(Auth::check()){
      $championships = Championship::where('id_user',Auth::id())->get();
      $calendar = $this->set_id_calendar($championships);
      $calendar = Calendar::whereIn('id_championships',$calendar)->get();
      return view('calendar.index',['championships' => $championships,'calendar' => $calendar]);
    }
  }
  /**
  *This function set all id championship for calendar
  *@param $championships
  *@return $calendar
  */
  private function set_id_calendar($championships){
    $calendar = [];
    for ($i=0; $i <count($championships) ; $i++) {
      $calendar[$i] = $championships[$i]->id;
    }
    return $calendar;
  }
  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create($id_championship){
    $weekdays = Weekday::find([1,2,3,4,5,6,7]);
    return view('calendar.create',['weekdays' => $weekdays,'id_champioship'=> $id_championship]);

  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $calendar_id = $this->insert_data_calendar($request);
    $time = explode(",",$request->input('values_time'));
    for ($i=0; $i < count($time); $i++) {
      for ($j=1; $j <= 7 ; $j++) {
        if($request->input('weekdays_'.$j) == $j){
          DB::table('weekdays_calendar')->insert(
            ['id_day' => $j, 'time_game' => $time[$i],'id_calendar' => $calendar_id]
          );
        }
      }
    }
    $this->generate_calendar($request->input('id_champioship'),$calendar_id);
    return redirect('calendar/index');
  }



  /**
  *insert in database all data  of calendar
  *@param Request $request
  *@return integer id_calendar
  */
  private function insert_data_calendar($request){
    return  DB::table('calendars')->insertGetId(
      ['round_trip_match' => ($request->input('customSwitch1') == 'on') ? true : false, 'id_championships' => $request->input('id_champioship')]
    );
  }

  private function generate_calendar($id_championship,$calendar_id){
    $teams = Team::select('id')->where('id_championships',$id_championship)->get();
    $matchs = array();
    foreach($teams as $k){
      foreach($teams as $j){
        if($k == $j){
          continue;
        }
        $z = array($k,$j);
        sort($z);
        if(!in_array($z,$matchs)){
          $matchs[] = $z;
        }
      }
    }
    foreach ($matchs as $key) {
      $match = new Match;
      $match->team_one =$key[0]->id;
      $match->team_two =$key[1]->id;
      $match->id_calendar = $calendar_id;
      $match->save();
    }
  }
  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id = null,$key = null){
    if(Auth::check()){
      return view('calendar.show',['id_championship' => $id]);
    }else{
      if($key != null){
        $user = User::where('share_key',$key)->get();
        if(count($user) == 0){
          return redirect('home') ;
        }else{
          return view('calendar.show',['id_championship' => $id]);
        }
      }else{
        return redirect('home');
      }
    }
  }

  /**
  *This function get all matches of a specific championships
  *@param $id_championship
  *@return Json with $matches,$start_championship and $teams
  */
  public function get_match($id_championship){
    $weekdays_calendar = DB::table('calendars')
    ->join('weekdays_calendar','calendars.id','=','weekdays_calendar.id_calendar')
    ->join('weekdays', 'weekdays_calendar.id_day', '=', 'weekdays.id')
    ->select('weekdays.day','weekdays_calendar.time_game')
    ->where('calendars.id_championships','=',$id_championship)
    ->get();
    $matches = DB::table('matches')
    ->join('calendars', 'matches.id_calendar', '=', 'calendars.id')
    ->select('calendars.round_trip_match','matches.*')
    ->where('calendars.id_championships','=',$id_championship)
    ->distinct('matches.id')
    ->orderBy('matches.team_one', 'asc')
    ->get();
    $start_championship = Championship::select('start_championship')
    ->where('id',$id_championship)
    ->get();
    $teams = Team::select('id','name')
    ->where('id_championships',$id_championship)
    ->get();
    return response()->json([
      'matches' => $matches,
      'start_championship' => $start_championship,
      'teams' => $teams,
      'weekend_time' => $weekdays_calendar
    ]);
  }
  /**
  * Show the form for editing the specified calendar.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id){
    $calendar = DB::table('calendars')
    ->join('weekdays_calendar','calendars.id','=','weekdays_calendar.id_calendar')
    ->join('weekdays', 'weekdays_calendar.id_day', '=', 'weekdays.id')
    ->select('calendars.*','weekdays.id as id_weekday','weekdays.day','weekdays_calendar.time_game')
    ->where('calendars.id_championships','=',$id)
    ->get();
    $weekdays = Weekday::find([1,2,3,4,5,6,7]);
    return view('calendar.edit',['calendar' => $calendar,'weekdays' => $weekdays,'id_champioship' => $id]);
  }
  /**
  *This function remove calendar by specific id of championship
  *@param $id
  *@return boolean
  */
  private function remove_calendar($id){
    $calendar = Calendar::where('id_championships',$id)->get();
    for ($i=0; $i <count($calendar); $i++) {
      Match::where('id_calendar', $calendar[$i]->id)->delete();
      Calendar::where('id', $calendar[$i]->id)->delete();
    }
    return true;
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
    $calendar = Calendar::find($id);
    $calendar->round_trip_match = ($request->input('customSwitch1') == 'on') ? true : false;
    $calendar->id_championships = $request->input('id_champioship');
    $calendar->save();
    $this->remove_element($id);
    $time = explode(",",$request->input('values_time'));
    for ($i=0; $i < count($time); $i++) {
      for ($j=1; $j < 7; $j++) {
        if($request->input('weekdays_'.$j) !=null){
          DB::table('weekdays_calendar')->insert(
            ['id_day' => $j, 'time_game' => $time[$i],'id_calendar' => $id]
          );
        }
      }
    }
    return redirect('calendar/index');
  }
  /**
  *This function remove element of table weekdays_calendar by calendar id
  *@param $request
  *@return void
  */
  private function remove_element($id){
    DB::table('weekdays_calendar')->where('id_calendar', '=', $id)->delete();
  }
  /**
  * Remove the specified calendar
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    if($this->remove_calendar($id)){
      alert()->success('El calendario ha sido eliminado de correctamente.');
      return redirect('calendar/index');
    }else{
      alert()->error('El calendario no se pudo eliminar de manera correcta.', '');
      return redirect('calendar/index');
    }
  }
}
