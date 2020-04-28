@extends('layouts.app')

@section('content')
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
<script type="text/javascript" src="{{ asset('js/championship.js') }}"></script>
  <div class="card card_option col-md-5 offset-md-3" >

    <img src="{{ asset('img/cup.png') }}" class="rounded mx-auto d-block icon_cup" alt="...">
    <div class="card-body col-md-12">
      <form action="{{ route('update',['id_champioship' =>$championship[0]->id]) }}" id="championship_form" method="post">
        @csrf
        <div class="form-group text-center">
          <label for="name_championship">Nombre del torneo</label>
          <input type="text" class="form-control" id="name_championship" name="name_championship" value="{{$championship[0]->name}}">
          <br>
          <div class="form-group col-md-12">
            <label for="start_match">Fecha de inicio del torneo</label>
            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
              <input type="text" class="form-control datetimepicker-input" id="start_match" name="start_match" data-target="#datetimepicker4" value="{{$start_championship}}" required/>
              <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>
          <br>
          <button type="button" class="btn btn-outline-success btn-lg btn-block" id="edit_championship"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Editar</button>
        </div>
      </form>
    </div>
  </div>
  <script type="text/javascript">
  $('#datetimepicker4').datetimepicker({
    format: 'L'
  });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection
