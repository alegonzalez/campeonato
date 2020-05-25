@extends('layouts.app')

@section('content')
  <script src="{{ asset('js/calendar.js') }}" defer></script>
  @foreach ($championships as $championship)
    @auth
      <div class="card card_option {{ (count($championships) == 1) ? 'col-8 offset-2 col-sm-5 offset-sm-3 col-md-5 offset-md-3 col-lg-4 offset-lg-4 col-xl-4 offset-xl-4':'col-8 offset-2 col-sm-5 offset-sm-1 col-md-4 offset-md-1 col-lg-3 offset-lg-1 col-xl-3 offset-xl-1' }}  shadow-drop-2-bottom" >
        <img src="{{ asset('img/cup.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
        <div class="card-body col-md-12">
          <h4 class="card-title">{{$championship->name}}</h4>
          <div class="offset-md-1">
            <?php $entry = 0; ?>
            @for ($i=0; $i < count($calendar); $i++)
              @if($calendar[$i]->id_championships == $championship->id)
                <?php $entry = 1; ?>
              @endif
            @endfor
            @if($entry != 1)
              <a href="{{ route('calendar/create',['id_champioship' =>$championship->id] ) }}" class="btn btn-outline-primary setting_button btn-lg btn-block"><i class="fa fa-plus" aria-hidden="true"></i> Crear calendario</a>
            @else
              <?php $entry = 0; ?>
              <a href="{{ route('calendar/show',['id_champioship' =>$championship->id] ) }}" class="btn btn-outline-success setting_button btn-lg btn-block"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Ver</a>
              <a href="{{ route('calendar/edit',['id_champioship' =>$championship->id] ) }}" class="btn btn-outline-success setting_button btn-lg btn-block"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Editar</a>
              <br>
              <form action="{{ route('calendar/destroy',['id_championship' => $championship->id])}}" method="POST" id="form_{{$championship->id}}">
                @method('DELETE')
                @csrf
                <button type="button"  class="btn btn-outline-danger  btn-lg btn-block" onclick="destroy_calendar('{{$championship->name}}','{{$championship->id}}');">
                  <i class="fa fa-trash" aria-hidden="true"></i> &nbsp;Eliminar
                </button>
              </form>
            @endif
          </div>
        </div>
      </div>
    @endauth
  @endforeach
    <script type="text/javascript" src="{{ asset('js/alert.js') }}"></script>
@endsection
