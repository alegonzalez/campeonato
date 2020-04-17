@extends('layouts.app')

@section('content')
  <script src="{{ asset('js/team.js') }}" defer></script>

  <div class="card col-md-6 offset-md-3 text-center" >
    <form   method="post" action="{{ route('team/storage') }}" enctype="multipart/form-data">
      @csrf
      @if ($errors->any())
        <?php
        $message = "";
        if($errors->has('id_championschip')){
          $message.= "Debes de seleccionar un torneo " . "\n";
        }
        if ($errors->has('name_team')) {
          $message.= "El campo nombre de equipo es requerido " . "\n";
        }
        if ($errors->has('upload_photo')) {
          $message.= "Solo se permite imagenes con formatos: jpeg,png,jpg " . "\n";
        }
        alert()->warning($message, 'Problemas al crear un nuevo equipo')->persistent('Close');
        ?>
      @endif

      <div class="form-group content_load_photo">
        <br><br>
        <label for="upload_photo">Cargar foto del equipo</label>
        <input type="file" accept="image/*"  onchange="readURL(this);" name="upload_photo" class="form-control-file offset-md-3" id="upload_photo">
      </div>
      <br>

      <div class="form-group">
        <label for="championship">Por favor seleccione el torneo</label>
        <input type="text" id="championship" list="list_championship" class="form-control"  placeholder="">
        <datalist id="list_championship">
          @foreach ($championships as $championship)
            <option value="{{$championship->name}}" id="{{$championship->id}}" class="option_championship" data-xyz="{{$championship->id}}">
            @endforeach
          </datalist>
          <br>
          <input type="hidden" name="id_championschip" id="id_championschip" >

        </div>


        <div class="card-body">
          <div class="form-group">
            <label for="name_team">Nombre del equipo</label>
            <input type="text" class="form-control-file" name="name_team" id="name_team">
          </div>
          <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Crear equipo</button>
        </div>

      </form>
    </div>

  @endsection
