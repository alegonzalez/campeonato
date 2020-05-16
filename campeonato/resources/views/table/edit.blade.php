@extends('layouts.app')

@section('content')
  <script src="{{ asset('js/table.js') }}" defer></script>
  <div class="card card_option col-md-6 offset-md-3" >
    <div class="card-body col-md-12">
      <form action="{{route('table/update',['id_table' =>$table[0]->id]) }}" id="form_edit_data_table" method="post">
        @csrf
        <div class="col-md-12 text-center">
          <h3>{{$table[0]->team_name}}</h3>
          <hr>
        </div>
        <br>
        <div class="form-group text-center">
          <label for="won_match">Partidos ganados</label>
          <input type="text" class="form-control" onkeyup ="only_number(document.getElementById('won_match').value,'won_match')" id="won_match" onkeyup ="only_number()" name="won_match" value="{{$table[0]->won_matches}}">
          <br>
        </div>
        <div class="form-group text-center">
          <label for="tied_matches">Partidos empatados</label>
          <input type="text" class="form-control" onkeyup ="only_number(document.getElementById('tied_matches').value,'tied_matches')" id="tied_matches" name="tied_matches" value="{{$table[0]->tied_matches}}">
          <br>
        </div>
        <div class="form-group text-center">
          <label for="lose_match">Partidos Perdidos</label>
          <input type="text" class="form-control"  onkeyup ="only_number(document.getElementById('lose_match').value,'lose_match')"  id="lose_match" name="lose_match" value="{{$table[0]->lost_matches}}">
          <br>
        </div>
        <br>
        <div class="form-group text-center">
          <label for="goals_scored">Goles anotados</label>
          <input type="text" class="form-control"  onkeyup ="only_number(document.getElementById('goals_scored').value,'goals_scored')" id="goals_scored" name="goals_scored" value="{{$table[0]->goals_scored}}">
          <br>
        </div>
        <div class="form-group text-center">
          <label for="goals_against">Goles en contra</label>
          <input type="text" class="form-control" onkeyup ="only_number(document.getElementById('goals_against').value,'goals_against')" id="goals_against" name="goals_against" value="{{$table[0]->goals_against}}">
          <br>
        </div>
        <button type="button" class="btn btn-outline-success  btn-lg btn-block" id="edit_specific_table" ><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Editar</button>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection
