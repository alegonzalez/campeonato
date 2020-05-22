@extends('layouts.app')

@section('content')
  <link  rel="stylesheet" href="{{ asset('css/team.css') }}" ></link>
  <script src="{{ asset('js/team.js') }}" defer></script>

  @if(count($championships) == 0)
    @if(Auth::check())
      <div  class=" col-md-12 offset-md-1 text-center slide-left">
        <h1 class="empty">No se encuentra ningún torneo registrado para crear los equipos.
        </h1>
      </div>
    @else
      <div  class=" col-md-12 offset-md-1 text-center slide-left">
        <h1 class="empty">No se encuentra ningún torneo registrado, debes informar a la persona que le brindo el acceso que elabore los torneos
          o bien puede crear sus propios torneos, solo debe de registrarse.
        </h1>
      </div>
    @endif

  @else
    <div class="card col-10 offset-1 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3" >
      <form action="{{ route('team/index') }}"  id="form_serch_team" method="get">
        <br>
        <label for="team">Por favor seleccione el torneo para ver sus respectivos equipos</label>
        <input type="text" id="team" list="list_team" class="form-control"  placeholder="">
        <datalist id="list_team">
          @foreach ($championships as $championship)
            <option value="{{$championship->name}}" id="{{$championship->id}}" class="option_championship" data-xyz="{{$championship->id}}">
            @endforeach
          </datalist>
          <br>
          <div class="col-md-12">
            <button type="button" class="btn btn-outline-warning  btn-block" id="search_team">
              <span class="material-icons">search</span>Buscar</button>
            </div>
            <br>
            <div class="col-md-12  text-right mb-3">
              <a href="{{ route('team/create' ) }}" class="btn btn-outline-primary btn-block setting_button"><i class="fa fa-plus" aria-hidden="true"></i> Crear equipo</a>
            </div>
            <input type="hidden" name="id_championschip" id="id_championschip">
          </form>
        </div>
        @auth
          @if(count($teams) > 0)
            @foreach ($teams as $team)
              <div class="card col-8 offset-2 col-sm-5  col-lg-3 col-xl-3 offset-xl-2 list_team_div shadow-drop-2-bottom" >
                <br>
                @if($team->path_image == "")
                  <img src="{{ asset('img/team1.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
                @else
                  <img src="{{ asset('storage/'.$team->path_image) }}" class="rounded mx-auto d-block icon_option" alt="...">
                @endif
                <div class="card-body col-md-12">
                  <h4 class="card-title">{{$team->name}}</h4>
                  <div class="offset-md-1">
                    <a href="{{ route('team/edit',['id_team' => $team->id] ) }}" class="btn btn-outline-success setting_button btn-lg btn-block"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Editar</a>
                    <br>
                    <form action="{{ route('team/destroy',['id_team' => $team->id])}}" method="POST" id="form_{{$team->id}}">
                      @method('DELETE')
                      @csrf
                      <button type="button"  class="btn btn-outline-danger setting_button btn-lg btn-block" id="{{$team->name . "_" . $team->id}}">
                        <i class="fa fa-trash" aria-hidden="true"></i> &nbsp;Eliminar
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            @endforeach
            <div class="col-md-2 offset-md-10 text-right mb-3">
              <br>
              {{$teams->links() }}
            </div>
          @else
            @if ($request_team == 'active')
              <div class="col-md-8 offset-md-3 slide-left">
                <br><br><br>
                <h1>No se encuentra ningún equipo registrado.</h1>
              </div>
            @endif
          @endif
        @endauth
      @endif
      <script type="text/javascript" src="{{ asset('js/alert.js') }}"></script>
    @endsection
