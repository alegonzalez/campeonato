@extends('layouts.app')

@section('content')
  <script src="{{ asset('js/jquery.min.js') }}" defer></script>
  <script src="{{ asset('js/player.js') }}" defer></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <div class="form-group col-sm-7 col-md-7 col-lg-7 col-xl-6">
    <label for="search_team">Buscar por equipo </label>
    <input type="text" class="form-control"  id="search_team" aria-describedby="emailHelp">
  </div>
  <div class="form-inline offset-4 offset-sm-1 offset-md-2 offset-lg-3 offset-xl-4">
    <a href="{{ route('player/create' ) }}" class="btn btn-outline-primary setting_button"><i class="fa fa-plus" aria-hidden="true"></i> Crear un jugador</a>
  </div>
  <br><br><br><br><br>
  <div class="table-responsive-md col-md-12">
    <table id="dtBasicExample" class="table table-striped table-bordered table-hover table-md col-md-12" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-md text-center">Nombre
          </th>
          <th class="th-md text-center">N° camiseta
          </th>
          <th class="th-md text-center">Pocisión
          </th>
          <th class="th-md text-center">Goles
          </th>
          <th class="th-md text-center">Editar
          </th>
          <th class="th-md text-center">Eliminar
          </th>
        </tr>
      </thead>
      <tbody>


      </tbody>

    </table>
  </div>
  <script type="text/javascript" src="{{ asset('js/alert.js') }}"></script>
@endsection
