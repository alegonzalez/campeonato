
@extends('layouts.app')

@section('content')
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
  <script src="{{ asset('js/calendar.js') }}" defer></script>
  <form class="" action="{{route('calendar/storage')}}" id="form_generate_calendar" method="post">
    @csrf
    <input type="hidden" name="id_champioship" value="{{$id_champioship}}">
    <div class="col-md-10 offset-md-2  text-center"> <h3>Seleccione los días en que se jugaran
      los partidos</h3> </div>
      @foreach ($weekdays as $weekday)
        <div class="card weekday  col-md-3 " onclick="chageColor({{$weekday->id}})"id="content_day_{{$weekday->id}}" >
          <div class="card-body text-center"> <h5
            class="card-title">{{$weekday->day}}</h5>
            <input type="hidden"name="weekdays_{{$weekday->id}}" id="weekdays_{{$weekday->id}}" value="">
          </div>
        </div>
      @endforeach
      <br><br>
      <div class="form-group col-md-8 offset-md-5">
        <label for="time_match">Elija los horarios en los que habrán partidos</label>
        <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
          <input type="text" class="form-control datetimepicker-input" id="time_match" data-target="#datetimepicker3"/>
          <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
          </div>
          <div class="col-md-8">
            <button type="button" class="btn btn-outline-warning" id="add_hour_match"><i class="fa fa-plus" aria-hidden="true"></i> </button>
          </div>
        </div>
      </div>
      <div class="col-md-3 offset-md-7">
        <ul class="list-group">
        </ul>
      </div>
      <input type="hidden" name="values_time" id="values_time">
      <br>
      <div class="custom-control custom-switch col-md-5 offset-md-6"> <br>
        <input type="checkbox" class="custom-control-input form-control" id="customSwitch1" name="customSwitch1">
        <label class="custom-control-label" for="customSwitch1">Partido ida y vuelta</label>
      </div>
      <br><br>
      <div class="col-md-5 offset-md-6">
        <button type="button" class="btn btn-primary" id="generate_calendar" name="button">Generar Calendario</button>
      </div>
    </form>
    <script type="text/javascript">
    $('#datetimepicker3').datetimepicker({
      format: 'LT'
    });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  @endsection
