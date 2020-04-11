<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Championship;
use Auth;
Use Alert;
//use SweetAlert;
use App\Providers\SweetAlertServiceProvider;
use UxWeb\SweetAlert\SweetAlert;

class ChampionshipController extends Controller
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
     * Show the main page, in this page you can see all championship of a specific user.
     * @return view championship/index.blade.php
     */
    public function index(){
        
        return view('championship.index',['list_championship' =>Championship::where('id_user', Auth::id())->get()]);
    }

    /**
     * This function show page to create a new championship
     * @return view championship/create.blade.php
     */
    public function create(){
        return view('championship.create');
    }
      /**
     * This function create and save a new championship in database
     * @return view championship/create.blade.php
     */
    public function storage(Request $request){
      
        if ($request->isMethod('post')) {
          if($request->input('name_championship') != ""){
            $championship = new Championship;
            $championship->name = $request->input('name_championship');
            $championship->id_user = Auth::id();
            $championship->save();
            alert()->success('El torneo ' . $championship->name . ' se ha creado exitosamente!!');
            return redirect('championship/index');
          }else{
            alert()->error('El campo nombre no puede quedar vacío.', 'Campo nombre vacío');
            return redirect('championship/create');
          }
        }
    }

    /**
     * This function show  page for  edit a specific championship
     * @return view championship/edit.blade.php
     */
    public function edit($id){
        return view('championship/edit',["championship"=>Championship::where('id', $id)->get()]);
    }
    /**
     * This function show  page for  edit a specific championship
     * @return view championship/edit.blade.php
     */
    public function update(Request $request){
        $championship = Championship::find(base64_decode($request->input('id_championship')));
        if ($request->isMethod('post')) {
            if($request->input('name_championship') != ""){
              $championship->name = $request->input('name_championship');
              $championship->save();
              alert()->success('El torneo ' . $championship->name . ' se actualizó exitosamente!!');
              return redirect('championship/index');
            }else{
              alert()->error('El campo nombre no puede quedar vacío.', 'Campo nombre vacío');
              return redirect('championship/edit',["championship"=>Championship::where('id', $id)->get()]);
            }
          }
        
    }

    /**
     * This function delete a specific championship
     * @return boolean 
     */
    public function destroy($id){

    }

}
