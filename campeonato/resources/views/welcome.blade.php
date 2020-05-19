@extends('layouts.app')
@section('content')
  <script type="text/javascript" src="{{ asset('js/share.js') }}"></script>
  @auth
    @section('share')
      <li class="nav-item active">
        <a class="nav-link" data-toggle="modal" data-target="#modal">Compartir</a>
      </li>
    @endsection

  @endauth
  @if($id_champioship == "" && $key == "")
    <div class="card card_option col-md-3 shadow-drop-2-bottom" >
      <img src="{{ asset('img/cup.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
      <div class="card-body col-md-12">
        <h4 class="card-title">Torneo</h4>
        <p class="card-text ">Puedes crear, editar y eliminar un torneo.</p>
        <a href="{{ route('championship/index') }}" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
      </div>
    </div>
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
    <div class="card card_option col-md-3 shadow-drop-2-bottom" >
      <br>
      <img src="{{ asset('img/calendar.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
      <div class="card-body col-md-12">
        <h4 class="card-title">Calendario</h4>
        @auth
          <p class="card-text ">Puedes visualizar,configurar la hora y fechas de los partidos y generar los encuentros.</p>
          <a href="{{route('calendar/index')}}" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
        @endauth
        @guest
          <p class="card-text ">Puedes visualizar la fecha y hora los partidos.</p>
          <a href="{{route('calendar/show',['id_champioship' => $id_champioship,'key' => $key])}}" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
        @endguest
      </div>
    </div>
    <div class="card card_option col-md-3 offset-1 shadow-drop-2-bottom" >
      <br>
      <img src="{{ asset('img/plane.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
      <div class="card-body col-md-12">
        <h4 class="card-title">Tabla general</h4>
        @auth
          <p class="card-text ">Puedes observar, agregar,edita o eliminar la información de los equipos como : cantidad de punto,partidos jugados,goles a favor, goles en contra y el rendimiento.</p>
          <a href="{{route('table/index',['key' => $key,'id_champioship' => $id_champioship])}}" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
        @endauth
        @guest
          <p class="card-text ">Puedes observar la información de los equipos como : cantidad de punto,partidos jugados,goles a favor, goles en contra y el rendimiento.</p>
          <a href="{{route('table/show',['id_championship' => $id_champioship,'key' => $key])}}" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
        @endguest
      </div>
    </div>
    <div class="card card_option col-md-3 offset-1 shadow-drop-2-bottom " >
      <br>
      <img src="{{ asset('img/referee.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
      <div class="card-body col-md-12 ">
        <h4 class="card-title">Indiciplina</h4>
        <p class="card-text ">Puedes observar, agregar, editar y eliminar tarjetas amarillas, tarjetas rojas a un jugador en especifico.</p>
        <a href="{{route('breach/index')}}" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
      </div>
    </div>


  @else
    <div class="card card_option col-md-3 shadow-drop-2-bottom" >
      <br>
      <img src="{{ asset('img/calendar.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
      <div class="card-body col-md-12">
        <h4 class="card-title">Calendario</h4>
        @auth
          <p class="card-text ">Puedes visualizar,configurar la hora y fechas de los partidos y generar los encuentros.</p>
          <a href="{{route('calendar/index')}}" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
        @endauth
        @guest
          <p class="card-text ">Puedes visualizar la fecha y hora los partidos.</p>
          <a href="{{route('calendar/show',['id_champioship' => $id_champioship,'key' => $key])}}" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
        @endguest
      </div>
    </div>

    <div class="card card_option col-md-3 offset-1 shadow-drop-2-bottom" >
      <br>
      <img src="{{ asset('img/plane.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
      <div class="card-body col-md-12">
        <h4 class="card-title">Tabla general</h4>
        @auth
          <p class="card-text ">Puedes observar, agregar,edita o eliminar la información de los equipos como : cantidad de punto,partidos jugados,goles a favor, goles en contra y el rendimiento.</p>
          <a href="{{route('table/index',['key' => $key,'id_champioship' => $id_champioship])}}" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
        @endauth
        @guest
          <p class="card-text ">Puedes observar la información de los equipos como : cantidad de punto,partidos jugados,goles a favor, goles en contra y el rendimiento.</p>
          <a href="{{route('table/show',['id_championship' => $id_champioship,'key' => $key])}}" class="btn btn-outline-primary btn-lg btn-block">Ir</a>
        @endguest
      </div>
    </div>
  @endif
  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="share_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title " id="share_modal">Compartir torneo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @if($championships != '')
            <ul class="list-group">

              @foreach ($championships as $championship)
                <li class="list-group-item text-center">{{$championship->name}}<br>
                  <input type="text" class="form-control" id ="{{$championship->id}}"value="http://localhost:8000/home/{{$championship->id}}/{{$share}}">
                  &nbsp; &nbsp; <button type="button" class="btn  btn-outline-warning" onclick="copy_link('{{$championship->id}}')">Copiar</button></li>
                @endforeach
              </ul>
            @endif
          </div>
          <div class="modal-footer">
            <span>Nota: La información que otros usuarios podrán ver  será unicamente la sección del calendario y la tabla general.</span>
          </div>
        </div>
      </div>
    </div>

  @endsection
