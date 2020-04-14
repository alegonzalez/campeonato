      @extends('layouts.app')

      @section('content')
      <div class="col-md-12  text-right mb-3">
        <a href="{{ route('championship/create' ) }}" class="btn btn-outline-primary setting_button"><i class="fa fa-plus" aria-hidden="true"></i> Crear</a>
      </div>
      @if(count($list_championship) == 0)
      <div  class="col-md-12 text-center">
        <h1 class="empty">No se encuentra ningun torneo registrado.</h1>
      </div>
      
      @else
      @foreach ($list_championship as $championship)
      @auth
      <div class="card card_option col-md-3 offset-md-1" >
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
        <!-- <a href="" class="btn btn-outline-danger setting_button btn-lg btn-block"><i class="fa fa-trash" aria-hidden="true"></i> &nbsp;Eliminar</a>-->
        </form>
        
        </div>
      </div>
      </div>    
      @endauth
      @endforeach
      
      <div class="col-md-2 offset-md-10 text-right mb-3">
        <br>
        {{ $list_championship->links() }}
      </div>
    
      @endif
      
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    @endsection