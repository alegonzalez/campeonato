@extends('layouts.app')

@section('content')
  <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/tempusdominus_bootstrap.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/tempusdominus_bootstrap.min.js') }}" />
  <script type="text/javascript" src="{{ asset('js/championship.js') }}"></script>
  <div class="card card_option col-10 offset-1 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-5 offset-xl-3" >
    <img src="{{ asset('img/cup.png') }}" class="rounded mx-auto d-block icon_cup" alt="...">
    <div class="card-body col-md-12">
      <form action="{{ route('storage') }}" id="championship_form" method="post">
        @csrf
        <div class="form-group text-center">
          <label for="name_championship">Nombre del torneo</label>
          <input type="text" class="form-control" id="name_championship" name="name_championship">
          <br>
          <div class="form-group col-md-12">
            <label for="start_match">Seleccione la fecha de inicio del torneo</label>
            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
              <input type="text" class="form-control datetimepicker-input" id="start_match" name="start_match" data-target="#datetimepicker4" required/>
              <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>
          <br>
          <button type="button" class="btn btn-outline-primary  btn-lg btn-block" id="create_championship"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Crear torneo</button>
        </div>
      </form>
    </div>
  </div>
  <script type="text/javascript">
  $('#datetimepicker4').datetimepicker({
    format: 'L'
  });
  </script>
  <script type="text/javascript" src="{{ asset('js/alert.js') }}"></script>

@endsection
