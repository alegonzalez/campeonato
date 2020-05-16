@extends('layouts.app')

@section('content')
  @auth
    @foreach ($championships as $championship)
      <div class="card card_option col-md-3 offset-md-1 shadow-drop-2-bottom" >
        <img src="{{ asset('img/cup.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
        <div class="card-body col-md-12">
          <h4 class="card-title">{{$championship->name}}</h4>
          <div class="offset-md-1">
            <a href="{{ route('table/show',['id_championship' => $championship->id] ) }}" class="btn btn-outline-info setting_button btn-lg btn-block"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Ver</a>
          </div>
        </div>
      </div>
    @endforeach
  @endauth
@endsection
