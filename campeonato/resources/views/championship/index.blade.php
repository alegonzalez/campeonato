@extends('layouts.app')
@section('content')
  <link href="{{ asset('css/championship.css') }}" rel="stylesheet">
  @if(count($list_championship) == 0)
    <div  class="col-md-12 text-center">
      <h1 class="empty">No se encuentra ningún torneo registrado.</h1>
    </div>
  @else
    @foreach ($list_championship as $championship)
        <div class="card card_option {{(count($list_championship) == 1)? 'col-8 offset-2 col-sm-6 offset-sm-3 col-md-5 col-lg-4 offset-md-4' : 'col-8 offset-2 col-sm-5 offset-sm-1 col-md-5 offset-md-1 col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 ' }}  shadow-drop-2-bottom" >
          @auth
          <img src="{{ asset('img/cup.png') }}" class="rounded mx-auto d-block icon_option" alt="...">
          <div class="card-body col-md-12">
            <h4 class="card-title">{{$championship->name}}</h4>
            <div class="offset-md-1">
              <a href="{{ route('championship/edit',['id_championship' => $championship->id] ) }}" class="btn btn-outline-success setting_button btn-lg btn-block"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Editar</a>
              <br>
              <form action="{{ route('destroy',['id_championship' => $championship->id])}}" method="POST" id="form_{{$championship->id}}">
                @method('DELETE')
                @csrf
                <button type="button"  class="btn btn-outline-danger setting_button btn-lg btn-block" id="{{$championship->name . "_" . $championship->id}}">
                  <i class="fa fa-trash" aria-hidden="true"></i> &nbsp;Eliminar
                </button>
              </form>
            </div>
          </div>
        </div>
      @endauth
    @endforeach
    <br>
    <div class="col-md-2 offset-md-10 text-right mb-3">
      <br>
      {{ $list_championship->links() }}
    </div>
  @endif
  <div class="col-md-11 offset-md-1 col-lg-10 col-xl-10 text-center div_create_button_championships">
    <a href="{{ route('championship/create' ) }}" class="btn btn-outline-primary setting_button "><i class="fa fa-plus" aria-hidden="true"></i> Crear torneo</a>
  </div>
  <script type="text/javascript" src="{{ asset('js/alert.js') }}"></script>
@endsection
