@extends('layouts.app')

@section('content')
  <script src="{{ asset('js/calendar.js') }}" defer></script>
  @foreach ($championships as $championship)
    @auth
      <div class="card card_option col-md-3 offset-md-1 shadow-drop-2-bottom" >
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection
