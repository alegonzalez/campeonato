@extends('layouts.app')

@section('content')
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="{{ asset('js/breach.js') }}" defer></script>
  <div class="card card_option col-md-6 offset-md-3" >
    <div class="card-body col-md-12">
      <form action="{{route('breach/update',['id_breach' => $breach[0]->id]) }}" id="form_breach"  method="post">
        @csrf
        <div class="col-md-12">
          <label for="team">Seleccione el equipo</label>
          <input list="list_team" class="form-control" name="team" id="team" value="{{$breach[0]->team_name}}">
          <datalist id="list_team">
            @foreach ($teams as $team)
              <option value="{{$team->name}}" id="{{$team->id}}" class="option_list_team" data-xyz="{{$team->id}}">
              @endforeach
            </datalist>
          </div>
          <div class="col-md-12 datalist_player">
            <label for="player">Seleccione el jugador</label>
            <input list="list_player" class="form-control" name="player" id="player" value="{{$breach[0]->player_name}}">
            <datalist id="list_player">
              @foreach ($players as $player)
                <option value="{{$player->name}}" id="{{$player->id}}" class="option_player" data-xyz="{{$player->id}}">
              @endforeach
            </datalist>
            <input type="hidden" name="id_player"  id="id_player" value="{{$breach[0]->id_player}}">
            <input type="hidden" id="number_matches_played" value="{{$breach[0]->played_matches}}">
          </div>
          <br>
          <div class="form-group text-center">
            <label for="yellow_card">Cantidad de tarjetas amarillas</label>
            <input type="text" class="form-control"  id="yellow_card" onkeyup ="only_number(document.getElementById('yellow_card').value,'yellow_card')" name="yellow_card" value="{{$breach[0]->yellow_card}}">
            <br>
          </div>
          <div class="form-group text-center">
            <label for="red_card">Cantidad de tarjetas rojas</label>
            <input type="text" class="form-control" id="red_card" onkeyup ="only_number(document.getElementById('red_card').value,'red_card')"  name="red_card" value="{{$breach[0]->red_card}}">
            <br>
          </div>
          <input type="hidden" name="id_championship" value="{{$breach[0]->id_championships}}">
          <button type="button" class="btn btn-outline-success  btn-lg btn-block" id="create_new_breach" ><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Editar</button>
        </form>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection
