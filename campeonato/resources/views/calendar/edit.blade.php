
@extends('layouts.app')

@section('content')
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
  <script src="{{ asset('js/calendar.js') }}" defer></script>
  <form  action="{{route('calendar/update',['id_champioship' => $id_champioship])}}" id="form_generate_calendar" method="post">
    @csrf
    <input type="hidden" name="id_champioship" value="{{$id_champioship}}">
    <div class="col-md-10 offset-md-2  text-center"> <h3>Seleccione los días en que se jugaran
      los partidos</h3> </div>
      <?php $entry = 0; ?>
      @foreach ($weekdays as $result)
        @foreach ($calendar as $key )
          @if($key->id_day == $result->id)
            <?php $entry = 1; ?>
          @endif
        @endforeach
        @if($entry == 1)
          <div class="card weekday  col-md-3 " style="color: rgb(255, 255, 255); background-color: rgb(17, 122, 139);" onclick="chageColor({{$result->id}}) "id="content_day_{{$result->id}}">
            <div class="card-body text-center"> <h5
              class="card-title">{{$result->day}}</h5>
              <input type="hidden"name="weekdays_{{$result->id}}" id="weekdays_{{$result->id}}" value="{{$result->id}}">
            </div>
          </div>
          <?php $entry = 0; ?>
        @else
          <div class="card weekday  col-md-3 " onclick="chageColor({{$result->id}})"id="content_day_{{$result->id}}" >
            <div class="card-body text-center"> <h5
              class="card-title">{{$result->day}}  </h5>
              <input type="hidden"name="weekdays_{{$result->id}}" id="weekdays_{{$result->id}}" >
            </div>
          </div>
        @endif

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
          <?php $time = array();
          $entry = 0;
          ?>
          @foreach ($calendar as $element)
            @for ($i=0; $i < count($time); $i++)
              @if($time[$i] == $element->time_game)
                <?php $entry = 1;?>
              @endif
            @endfor
            @if($entry != 1 )
              <li class="list-group-item"> {{$element->time_game}} &nbsp; <button type="button" class="btn btn-outline-danger" onclick="remove_time(this);">    <i class="fa fa-trash" aria-hidden="true"></i> </button></li>
              <?php array_push($time,$element->time_game);?>
            @else
              <?php $entry = 0; ?>
            @endif
          @endforeach
        </ul>
      </div>
      <input type="hidden" name="values_time" id="values_time">
      <br>
      <div class="custom-control custom-switch col-md-5 offset-md-6"> <br>
        <input type="checkbox" class="custom-control-input form-control" id="customSwitch1" name="customSwitch1" {{($calendar[0]->round_trip_match == 1) ? 'checked' : ''}}>
        <label class="custom-control-label" for="customSwitch1">Partido ida y vuelta</label>
      </div>
      <br><br>
      <div class="col-md-5 offset-md-6">
        <button type="button" class="btn btn-primary" id="generate_calendar" name="button">Actualizar Calendario</button>
      </div>
    </form>

    <script type="text/javascript">
    $('#datetimepicker3').datetimepicker({
      format: 'LT'
    });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  @endsection
