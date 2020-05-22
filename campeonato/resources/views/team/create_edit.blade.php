@extends('layouts.app')

@section('content')
  <link  rel="stylesheet" href="{{ asset('css/team.css') }}" ></link>
  <script src="{{ asset('js/team.js') }}" defer></script>
  <div class="card col-10 offset-1  col-md-10 offset-md-1 col-lg-9 offset-lg-2 col-xl-8  text-center" >
    <form   method="post" action="{{ ($action == 'create') ?  route('team/storage') : route('team/update',['id_team' =>$team[0]->id]) }}" enctype="multipart/form-data">
      @csrf
      @if ($errors->any())
        <?php
        $message = "";
        $cont = 1;
        if($errors->has('id_championschip')){
          $message.= $cont . "- Debes de seleccionar un torneo " . "\n";
          $cont++;
        }
        if ($errors->has('name_team')) {
          $message.= $cont . "- El campo nombre de equipo es requerido " . "\n";
          $cont++;
        }
        if ($errors->has('upload_photo')) {
          $message.= $cont . "- Solo se permite imagenes con formatos: jpeg,png,jpg " . "\n";
          $cont++;
        }
        alert()->warning($message, 'Problemas al crear un nuevo equipo')->persistent('Close');
        ?>
      @endif
      <div class="form-group content_load_photo ">
        <br><br>
        @if($action =='edit')
          @if($team[0]->path_image == "")
            <br class="line_break"><img src='{{ asset('img/team1.png') }}' class='img-circle img_team' id='img_show_image' alt='La image no se pudo cargar'>
          @else
            <br class="line_break"><img src='{{ asset('storage/'.$team[0]->path_image) }}' class='img-circle img_team' id='img_show_image' alt='La image no se pudo cargar'>
          @endif
        @endif
        <br><br>
      </div>
      <div class=" col-7 offset-3 col-sm-7 offset-sm-3 col-md-7 offset-md-3 col-lg-8 offset-lg-4 col-xl-8 offset-xl-4">
        <label for="upload_photo" id="label_load_photo">Cargar foto del equipo
          <input type="file" accept="image/*"  onchange="readURL(this);" name="upload_photo" class="form-control-file offset-md-3" id="upload_photo">
        </label>
      </div>
      <br>
      <div class="form-group">
        <label for="championship">Por favor seleccione el torneo</label>
        <input type="text" id="championship" list="list_championship" class="form-control" value="{{isset($team[0]->name_championship) ? $team[0]->name_championship : '' }}"  placeholder="">
        <datalist id="list_championship">
          @foreach ($championships as $championship)
            <option value="{{$championship->name}}" id="{{$championship->id}}" class="option_championship" data-xyz="{{$championship->id}}">
            @endforeach
          </datalist>
          <br>
          <input type="hidden" name="id_championschip" id="id_championschip" value="{{($action == 'create' ? '' : $team[0]->id_championships)}}" >
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="name_team">Nombre del equipo</label>
            <input type="text" class="form-control" name="name_team" id="name_team" value='{{($action == 'create') ? '' : $team[0]->name}}'>
          </div>
          <?php  $icon = ($action == 'create') ? "<i class='fa fa-plus' aria-hidden='true'></i>" : "<i class='fa fa-pencil' aria-hidden='true'></i>"?>
          <button type="submit" class="btn {{($action == 'create') ? 'btn-primary' : 'btn-success' }}"> <?php echo $icon;  ?>  {{($action == 'create') ? 'Crear equipo' : 'Editar Equipo'}}</button>
        </div>
      </form>
    </div>
    <script type="text/javascript" src="{{ asset('js/alert.js') }}"></script>
  @endsection
