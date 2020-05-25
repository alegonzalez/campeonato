
@extends('layouts.app')

@section('content')
  <script src="{{ asset('js/jquery.min.js') }}" ></script>
  <script src="{{ asset('js/moment.min.js') }}" ></script>
  <script src="{{ asset('js/tempusdominus_bootstrap.min.js') }}" ></script>
  <link rel="stylesheet" href="{{ asset('css/tempusdominus_bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{asset('css/calendar.css')}}">
  <script src="{{ asset('js/calendar.js') }}" defer></script>
  <form class="" action="{{route('calendar/storage')}}" id="form_generate_calendar" method="post">
    @csrf
    <input type="hidden" name="id_champioship" value="{{$id_champioship}}">
    <div class="col-lg-10 offset-lg-1 col-xl-9 offset-xl-2  text-center"> <h3>Seleccione los días en que se jugaran
      los partidos</h3> </div>
      @foreach ($weekdays as $weekday)
        <div class="card weekday col-8 col-sm-4  col-md-3 " onclick="chageColor({{$weekday->id}})"id="content_day_{{$weekday->id}}" >
          <div class="card-body text-center"> <h5
            class="card-title">{{$weekday->day}}</h5>
            <input type="hidden"name="weekdays_{{$weekday->id}}" id="weekdays_{{$weekday->id}}" value="">
          </div>
        </div>
      @endforeach
      <br><br>
      <div class="form-group col-10 offset-1 col-sm-10 offset-sm-1  col-md-7 offset-md-3 col-lg-6 offset-lg-3 col-xl-5
      offset-xl-4">
      <label for="time_match">Elija los horarios en los que habrán partidos</label>
      <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" id="time_match" data-target="#datetimepicker3"/>
        <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
        </div>
        <div class="col-9 offset-3 col-sm-8 col-md-8">
          <button type="button" class="btn btn-outline-warning" id="add_hour_match"><i class="fa fa-plus" aria-hidden="true"></i> Agregar hora</button>
        </div>
      </div>
    </div>
    <div class="col-6 offset-3 col-sm-5 offset-sm-3 col-md-4 offset-md-4 col-lg-3 offset-lg-4 col-xl-3 offset-xl-4">
      <ul class="list-group list_hour">
      </ul>
    </div>
    <input type="hidden" name="values_time" id="values_time">
    <br>
    <div class="custom-control custom-switch col-8 offset-3 col-sm-6 offset-sm-3 col-md-6 offset-md-4 col-lg-6 offset-lg-5 col-xl-6 offset-xl-5"> <br>
      <input type="checkbox" class="custom-control-input form-control" id="customSwitch1" name="customSwitch1">
      <label class="custom-control-label" for="customSwitch1">Partido ida y vuelta</label>
    </div>
    <br><br>
    <div class="col-6 offset-4 col-sm-5 offset-sm-4 col-md-5 offset-md-5 col-lg-5 offset-lg-5 col-xl-5 offset-xl-5">
      <button type="button" class="btn btn-primary" id="generate_calendar" name="button"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Generar calendario</button>
    </div>
  </form>
  <script type="text/javascript">
  $('#datetimepicker3').datetimepicker({
    format: 'LT'
  });

  </script>
  <script type="text/javascript" src="{{ asset('js/alert.js') }}"></script>
@endsection
