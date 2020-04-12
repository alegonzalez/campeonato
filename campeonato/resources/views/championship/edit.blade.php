@extends('layouts.app')

@section('content')
<div class="card card_option col-md-5 offset-md-3" >
    
    <img src="{{ asset('img/cup.png') }}" class="rounded mx-auto d-block icon_cup" alt="...">
    <div class="card-body col-md-12">
        <form action="{{ route('update') }}" method="post">
            @csrf
            <div class="form-group text-center">
                <label for="name_championship">Nombre del torneo</label>
                <input type="text" class="form-control" id="name_championship" name="name_championship" value="{{$championship[0]->name}}">
                <!--<input type="hidden" name="id_championship" value="{{base64_encode($championship[0]->id)}}">-->
                <br>
                <button class="btn btn-outline-success setting_button btn-lg btn-block" id="{{$championship[0]->id}})"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Editar</button>
              </div>
        </form>
    </div>
    </div> 
@endsection