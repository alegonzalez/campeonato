@extends('layouts.app')
@section('content')<br><br>
  @auth
    <div class="card card_option col-md-3 shadow-drop-2-bottom" >
      <img src="{{ asset('img/cup.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
      <div class="card-body col-md-12">
        <h4 class="card-title">Torneo</h4>
        <p class="card-text ">Puedes crear, editar y eliminar un torneo.</p>
        <a href="{{ route('championship/index') }}" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
      </div>
    </div>
  @endauth
  <div class="card card_option col-md-3 offset-md-1 shadow-drop-2-bottom" >
    <br>
    <img src="{{ asset('img/team1.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
    <div class="card-body col-md-12">
      <h4 class="card-title">Equipo</h4>
      @auth
        <p class="card-text ">Puedes crear, editar y eliminar un equipo.</p>
      @endauth
      @guest
        <p class="card-text ">Puedes  visualizar la lista equipos.</p>
      @endguest
      <a href="{{ route('team/index',['key' => $key]) }}" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
    </div>
  </div>
  <div class="card card_option col-md-3  offset-md-1 shadow-drop-2-bottom" >
    <br>
    <img src="{{ asset('img/football_player.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
    <div class="card-body col-md-12">
      <h4 class="card-title">Jugador</h4>
      @auth
        <p class="card-text ">Puedes crear, editar, eliminar un jugador de su respectivo equipo y entre otras cosas...</p>
      @endauth
      @guest
        <p class="card-text ">Puedes visualizar la información de los jugadores que pertenecen a un equipo.</p>
      @endguest
      <a href="{{route('player/index')}}" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
    </div>
  </div>
  @auth
    <div class="card card_option col-md-3 shadow-drop-2-bottom" >
      <br>
      <img src="{{ asset('img/calendar.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
      <div class="card-body col-md-12">
        <h4 class="card-title">Calendario</h4>
        @auth
          <p class="card-text ">Puedes visualizar,configurar la hora y fechas de los partidos y generar los encuentros.</p>
        @endauth
        @guest
          <p class="card-text ">Puedes visualizar la fecha y hora los partidos.</p>
        @endguest
        <a href="{{route('calendar/index',['key' => $key,'id_champioship' => $id_champioship])}}" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
      </div>
    </div>
  @endauth
  @guest
    <div class="card card_option col-md-3  offset-md-1 shadow-drop-2-bottom" >
      <br>
      <img src="{{ asset('img/calendar.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
      <div class="card-body col-md-12">
        <h4 class="card-title">Calendario</h4>
        @auth
          <p class="card-text ">Puedes visualizar,configurar la hora y fechas de los partidos y generar los encuentros.</p>
        @endauth
        @guest
          <p class="card-text ">Puedes visualizar la fecha y hora los partidos.</p>
        @endguest
        <a href="{{route('calendar/index',['key' => $key,'id_champioship' => $id_champioship])}}" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
      </div>
    </div>
  @endguest
  <div class="card card_option col-md-3 offset-1 shadow-drop-2-bottom" >
    <br>
    <img src="{{ asset('img/plane.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
    <div class="card-body col-md-12">
      <h4 class="card-title">Tabla general</h4>
      @auth
        <p class="card-text ">Puedes observar, agregar,edita o eliminar la información de los equipos como : cantidad de punto,partidos jugados,goles a favor, goles en contra y el rendimiento.</p>
      @endauth
      @guest
        <p class="card-text ">Puedes observar la información de los equipos como : cantidad de punto,partidos jugados,goles a favor, goles en contra y el rendimiento.</p>
      @endguest
      <a href="#" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
    </div>
  </div>
  <div class="card card_option col-md-3 offset-1 shadow-drop-2-bottom " >
    <br>
    <img src="{{ asset('img/referee.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
    <div class="card-body col-md-12 ">
      @auth
        <h4 class="card-title">Indiciplina</h4>
        <p class="card-text ">Puedes observar, agregar, editar y eliminar tarjetas amarillas, tarjetas rojas a un jugador en especifico.</p>
      @endauth
      @guest
        <h4 class="card-title">Indiciplina</h4>
        <p class="card-text ">Puedes observar la siguiente información: cantidad de tarjetas amarillas y rojas hacia los jugadores.</p>
      @endguest
      <a href="#" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
    </div>
  </div>
@endsection
