@extends('layouts.app')

@section('content')

  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="{{ asset('js/player.js') }}" defer></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <div class="col-md-12  text-right mb-3">
    <a href="{{ route('player/create' ) }}" class="btn btn-outline-primary setting_button"><i class="fa fa-plus" aria-hidden="true"></i> Crear</a>
  </div>
  <div class="form-group col-md-8">
    <label for="search_team">Buscar por eqipo </label>
    <input type="text" class="form-control"  id="search_team" aria-describedby="emailHelp">
  </div>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection
