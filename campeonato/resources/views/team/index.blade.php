@extends('layouts.app')

@section('content')
  <script src="{{ asset('js/team.js') }}" defer></script>
  @auth
    <div class="col-md-12  text-right mb-3">
      <a href="{{ route('team/create' ) }}" class="btn btn-outline-primary setting_button"><i class="fa fa-plus" aria-hidden="true"></i> Crear</a>
    </div>
  @endauth

  @if(count($championships) == 0))
    <div  class="col-md-12 text-center">
      <h1 class="empty">No se encuentra ningun torneo registrado, debes informar a la persona que le brindo el acceso que elabore los torneos
        o bien puede crear sus propios torneos, solo debe de registrarse.
      </h1>
    </div>
  @else

    <div class="card  col-md-6 offset-md-3" >
      <form action="{{ route('team/index',['key_share' =>isset($key_share) ? $key_share : ""]) }}"  id="form_serch_team" method="get">
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
            <button type="button" class="btn btn-outline-primary  btn-block" id="search_team"><i class="fas fa-search"></i></i>Buscar</button>
          </div>
          <br>
          <input type="hidden" name="id_championschip" id="id_championschip">
        </form>

      </div>

      @auth
        @if(count($teams))
          @foreach ($teams as $team)
            <div class="card col-md-3 offset-md-1 list_team" >
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
        @endif
      @endauth
      @guest
        @if(count($teams))
          @foreach ($teams as $team)
            <div class="card col-md-3 offset-md-1 list_team" >
              <br>
              @if($team->path_image == "")
                <img src="{{ asset('img/team1.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
              @else
                <img src="{{ asset('storage/'.$team->path_image) }}" class="rounded mx-auto d-block icon_option" alt="...">
              @endif
              <div class="card-body col-md-12">
                <h4 class="card-title">{{$team->name}}</h4>
              </div>
            </div>
          @endforeach
          <div class="col-md-2 offset-md-10 text-right mb-3">
            <br>
            {{$teams->links() }}
          </div>
        @endif
      @endguest

    @endif
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  @endsection
