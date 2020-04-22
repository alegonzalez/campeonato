@extends('layouts.app')

@section('content')
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="{{ asset('js/player.js') }}" defer></script>
  <div class="card col-md-6 offset-md-3 text-center" >
    <form class="" action="{{ ($action == 'create') ?  route('player/storage') : route('player/update',['id_player' =>$player[0]->id]) }}" id="form-player" method="post">
      @csrf
      <br>
      @if ($errors->any())
        <?php
        $message = "";
        $cont = 1;
        if($errors->has('id_championschip')){
          $message.= $cont . "- Debes de seleccionar un torneo. " . "\n";
          $cont++;
        }
        if ($errors->has('id_team')) {
          $message.= $cont . "- Debes seleccionar un equipo. " . "\n";
          $cont++;
        }
        if ($errors->has('player_name')) {
          $message.= $cont . "- El nombre del jugador es requerido. " . "\n";
          $cont++;
        }
        if ($errors->has('shirt_number')) {
          $message.= $cont . "- El campo número de camiseta solamente debe contener números. " . "\n";
          $cont++;
        }
        if ($errors->has('position')) {
          $message.= $cont . "- Debes seleccionar la pocisión de en la que jugará. " . "\n";
          $cont++;
        }
        alert()->warning($message, 'Problemas al crear un nuevo jugador')->persistent('Close');
        ?>
      @endif
      <div class=" datalist_championship">
        <label for="championship">Por favor seleccione el torneo</label>
        @if($action == 'edit')
          @foreach ($championships as $championship)
            @if($championship->id == $team[0]->id_championships)
              <input type="text" id="championship" list="list_championship" class="form-control" value="{{$championship->name}}" required>
            @endif
          @endforeach
        @else
          <input type="text" id="championship" list="list_championship" class="form-control" value="" required>
        @endif

        <datalist id="list_championship">
          @foreach ($championships as $championship)
            <option value="{{$championship->name}}" id="{{$championship->id}}" class="option_championship" data-xyz="{{$championship->id}}">
            @endforeach
          </datalist>
          <br>
          <input type="hidden" name="id_championschip" id="id_championschip" value="{{($action == 'create' ? '' : $team[0]->id_championships)}}" >

        </div>
        <br>
        <div class=" datalist_team {{($action == 'create') ? 'disable_div' : ''}}">
          <label for="championship">Por favor seleccione el equipo</label>
          <input type="text" id="team" list="list_team" class="form-control" value="{{($action == 'edit' ? $player[0]->name_team : '')}}"   required>
          <datalist id="list_team">

            <br>
            @isset($teams)
              @if(count($teams) > 0)
                @foreach ($teams as $team)
                  <option value="{{$team->name}}" id="{{$team->id}}" class='option_team' data-xyz="{{$team->id}}">
                  @endforeach
                @endif
              @endisset
            </datalist>
            <input type="hidden" name="id_team" id="id_team" value="{{($action == 'create' ? '' : $player[0]->id_team)}}" >

          </div>
          <br>
          <div class="form-group {{($action == 'create') ? 'disable_div' : ''}}">
            <label for="player_name">Nombre del jugador</label>
            <input type="text" class="form-control" id="player_name" value="{{($action == 'create') ? '' : $player[0]->name}}" name="player_name" required>
          </div>
          <div class="form-group {{($action == 'create') ? 'disable_div' : ''}}">
            <label for="shirt_number">Número de camiseta</label>
            <input type="text" class="form-control" id="shirt_number" value="{{($action == 'create') ? '' : $player[0]->shirt_number}}" name="shirt_number" required>
          </div>
          <div class="form-group {{($action == 'create') ? 'disable_div' : ''}}">
            <label for="shirt_number">Pocisión de juego</label>
          </div>
          @foreach ($game_position as $position)
            @if($action == 'edit')
              @if ($position->id == $player[0]->id_position_game)
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="position" id="position_{{$position->id}}" value="{{$position->id}}" checked >
                  <label class="form-check-label" for="position_{{$position->id}}">
                    {{$position->name}}
                  </label>
                </div>
              @else
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="position" id="position_{{$position->id}}" value="{{$position->id}}" >
                  <label class="form-check-label" for="position_{{$position->id}}">
                    {{$position->name}}
                  </label>
                </div>
              @endif
            @else
              <div class="form-check form-check-inline disable_div">
                <input class="form-check-input" type="radio" name="position" id="position_{{$position->id}}" value="{{$position->id}}" >
                <label class="form-check-label" for="position_{{$position->id}}">
                  {{$position->name}}
                </label>
              </div>
            @endif

          @endforeach
          <br><br>
          <div class="form-group {{($action == 'create') ? 'disable_div' : ''}}">
            <label for="goals">Cantidad de goles</label>
            <input type="text" class="form-control" id="goals" name="goals" value="0">
          </div>
          <?php  $icon = ($action == 'create') ? "<i class='fa fa-plus' aria-hidden='true'></i>" : "<i class='fa fa-pencil' aria-hidden='true'></i>"?>
          <button type="button" class="btn btn-primary" id="button_create_edit" > <?php echo $icon;  ?>  {{($action == 'create') ? 'Crear jugador' : 'Editar Jugador'}}</button>

        </form>
        <br>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    @endsection
