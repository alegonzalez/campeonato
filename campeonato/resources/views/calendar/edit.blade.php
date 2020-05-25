
@extends('layouts.app')

@section('content')
  <script src="{{ asset('js/jquery.min.js') }}" ></script>
  <script src="{{ asset('js/moment.min.js') }}" ></script>
  <script src="{{ asset('js/tempusdominus_bootstrap.min.js') }}" ></script>
  <link rel="stylesheet" href="{{ asset('css/tempusdominus_bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{asset('css/calendar.css')}}">
  <script src="{{ asset('js/calendar.js') }}" defer></script>
  <form  action="{{route('calendar/update',['id_calendar' => $calendar[0]->id])}}" class="col-md-12" id="form_generate_calendar" method="post">
    @csrf
    <input type="hidden" name="id_champioship" value="{{$id_champioship}}">
    <div class="col-lg-10 offset-lg-1 col-xl-9 offset-xl-1  text-center"> <h3>Seleccione los días en que se jugaran
      los partidos</h3> </div>
      <?php $entry = 0; ?>
      @foreach ($weekdays as $result)
        @foreach ($calendar as $key )
          @if($key->id_weekday == $result->id)
            <?php $entry = 1; ?>
          @endif
        @endforeach
        @if($entry == 1)
          <div class="card weekday col-8 col-sm-4  col-md-3 " style="color: rgb(255, 255, 255); background-color: rgb(17, 122, 139);" onclick="chageColor({{$result->id}}) "id="content_day_{{$result->id}}">
            <div class="card-body text-center"> <h5
              class="card-title">{{$result->day}}<span class="material-icons">done</span></h5>
              <input type="hidden"name="weekdays_{{$result->id}}" id="weekdays_{{$result->id}}" value="{{$result->id}}">
            </div>
          </div>
          <?php $entry = 0; ?>
        @else
          <div class="card weekday col-8 col-sm-4  col-md-3 " onclick="chageColor({{$result->id}})"id="content_day_{{$result->id}}" >
            <div class="card-body text-center"> <h5
              class="card-title">{{$result->day}}  </h5>
              <input type="hidden"name="weekdays_{{$result->id}}" id="weekdays_{{$result->id}}" >
            </div>
          </div>
        @endif

      @endforeach
      <br><br>
      <div class="form-group col-10 offset-1 col-sm-10 offset-sm-1  col-md-7 offset-md-3 col-lg-6 offset-lg-3 col-xl-5
      offset-xl-3">
      <label for="time_match">Elija los horarios en los que habrán partidos</label>
      <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" id="time_match" data-target="#datetimepicker3"/>
        <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
        </div>
        <div class="col-12 offset-3 col-sm-8 col-md-8">
          <button type="button" class="btn btn-outline-warning" id="add_hour_match"><i class="fa fa-plus" aria-hidden="true"></i> Agregar hora</button>
        </div>
      </div>
    </div>


    <div class="col-6 offset-3 col-sm-5 offset-sm-3 col-md-4 offset-md-4 col-lg-3 offset-lg-4 col-xl-3 offset-xl-4">
      <ul class="list-group list_hour">
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
            <li class="list-group-item"> {{$element->time_game}} &nbsp; <button type="button" class="btn btn-outline-danger remove_hour" onclick="remove_time(this);">    <i class="fa fa-trash" aria-hidden="true"></i> </button></li>
            <?php array_push($time,$element->time_game);?>
          @else
            <?php $entry = 0; ?>
          @endif
        @endforeach
      </ul>
    </div>
    <input type="hidden" name="values_time" id="values_time">
    <br>
    <div class="custom-control custom-switch col-8 offset-3 col-sm-6 offset-sm-3 col-md-6 offset-md-4 col-lg-6 offset-lg-5 col-xl-6 offset-xl-4"> <br>
      <input type="checkbox" class="custom-control-input form-control" id="customSwitch1" name="customSwitch1" {{($calendar[0]->round_trip_match == 1) ? 'checked' : ''}}>
      <label class="custom-control-label" for="customSwitch1">Partido ida y vuelta</label>
    </div>
    <br><br>
    <div class="col-6 offset-4 col-sm-5 offset-sm-4 col-md-5 offset-md-5 col-lg-5 offset-lg-5 col-xl-5 offset-xl-4">
      <button type="button" class="btn btn-success" id="generate_calendar" name="button"><i class='fa fa-pencil' aria-hidden='true'></i>&nbsp;Editar calendario</button>
    </div>
  </form>

  <script type="text/javascript">
  $('#datetimepicker3').datetimepicker({
    format: 'LT'
  });

  </script>
  <script type="text/javascript" src="{{ asset('js/alert.js') }}"></script>
@endsection
