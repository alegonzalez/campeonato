<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use App\User;

class UserController extends Controller
{
    /**
     * This function share page to other pleople
     */
    public function share_page(){
        $user = User::find(Auth::id());
        if($user->share_key == ""){
            $encode = base64_encode(Auth::id());
            $generate = Str::random(10);
            $user->share_key = $encode . "-" . $generate;
            $user->save();
            alert()->success('http://localhost:8000/home/' . $user->share_key,'Link para compartir')->persistent('Close'); 
            return redirect('home/'. session('encode'));
        }else{
            alert()->success('http://localhost:8000/home/' . $user->share_key,'Link para compartir')->persistent('Close'); 
            return redirect('home/'. session('encode'));
        }
    }
}
