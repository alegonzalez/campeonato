<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Championship;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id_championship = null,$key = null)
    {
      if(Auth::check()){
        $user = User::find(Auth::id());
        if($user->share_key == ""){
            $encode = base64_encode(Auth::id());
            $generate = Str::random(10);
            $user->share_key = $encode . "-" . $generate;
            $user->save();
        }
        $championships = Championship::select('id','name')->where('id_user',Auth::id())->get();
        return view('welcome',['championships' => $championships,'key' => $key,'id_champioship' => $id_championship,'share' => $user->share_key]);
      }
        return view('welcome',['key' => $key,'id_champioship' => $id_championship,'championships' => '']);
    }
}
