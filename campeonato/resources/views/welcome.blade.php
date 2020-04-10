@extends('layouts.app')

@section('content')<br><br>

<div class="card card_option col-md-3" >
    
    <img src="{{ asset('img/cup.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
    <div class="card-body col-md-12">
      <h4 class="card-title">Torneo</h4>
      <p class="card-text ">Puedes crear, editar y eliminar un torneo.</p>
      <a href="#" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
    </div>
  </div>
  <div class="card card_option col-md-3 offset-md-1" >
    <br>
    <img src="{{ asset('img/team1.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
    <div class="card-body col-md-12">
      <h4 class="card-title">Equipo</h4>
      <p class="card-text ">Puedes crear, editar y eliminar un equipo.</p>
      <a href="#" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
    </div>
  </div>
  <div class="card card_option col-md-3  offset-md-1" >
    <br>
    <img src="{{ asset('img/football_player.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
    <div class="card-body col-md-12">
      <h4 class="card-title">Jugador</h4>
      <p class="card-text ">Puedes crear, editar y eliminar un jugador de su respectivo equipo.</p>
      <a href="#" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
    </div>
  </div>
  <div class="card card_option col-md-3 " >
    <br>
    <img src="{{ asset('img/calendar.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
    <div class="card-body col-md-12">
      <h4 class="card-title">Calendario</h4>
      <p class="card-text ">Puedes configurar la hora y fechas de los partidos y generar los encuentros.</p>
      <a href="#" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
    </div>
  </div>
  <div class="card card_option col-md-3 offset-1 " >
    <br>
    <img src="{{ asset('img/plane.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
    <div class="card-body col-md-12">
                                                    <p class="card-text ">Puedes observar la informacion de los equipos como : cantidad de punto,partidos jugados,goles a favor, goles en contra y el rendimiento.</p>
      <a href="#" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
    </div>
  </div>
  <div class="card card_option col-md-3 offset-1  " >
    <br>
    <img src="{{ asset('img/referee.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
    <div class="card-body col-md-12">
      <h4 class="card-title">Indiciplina</h4>
      <p class="card-text ">Puedes observar la siguiente información: cantidad de tarjetas amarillas y rojas hacia los jugadores.</p>
      <a href="#" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
    </div>
  </div>

@endsection
