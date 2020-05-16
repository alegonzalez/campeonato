@extends('layouts.app')

@section('content')
  <div class="table-responsive-md col-md-12">
    <table id="dtBasicExample" class="table table-striped table-bordered table-hover table-md col-md-12" cellspacing="0" width="100%">
      <thead>
        <tr class="text-center">
          <th class="th-md text-center">Número
          </th>
          <th class="th-md text-center">Nombre del equipo
          </th>
          <th class="th-md text-center">PJ
          </th>
          <th class="th-md text-center">PG
          </th>
          <th class="th-md text-center">PE
          </th>
        <th class="th-md text-center">PP
          </th>
          <th class="th-md text-center">GF
          </th>
          <th class="th-md text-center">GC
          </th>
          <th class="th-md text-center">Pts
          </th>
          <th class="th-md text-center">Rendimiento
          </th>
          @auth
            <th class="th-md text-center">Editar
            </th>
          @endauth
        </tr>
      </thead>
      <tbody>
        <?php $cont = 0; ?>
        @foreach ($table as $data)
          <?php $cont += 1; ?>
          <tr class="text-center">
            <th scope="row">{{$cont}}</th>
            <td>{{$data->team_name}}</td>
            <td>{{$data->played_matches}}</td>
            <td>{{$data->won_matches}}</td>
            <td>{{$data->tied_matches}}</td>
            <td>{{$data->lost_matches}}</td>
            <td>{{$data->goals_scored}}</td>
            <td>{{$data->goals_against}}</td>
            <td>{{$data->points}}</td>
            <td>{{$data->performance * 100}}%</td>
            @auth
            <td><a href="{{ route('table/edit',['id_table' =>$data->id] ) }}" class="btn btn-outline-success setting_button btn-lg btn-block"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;</a></td>
            @endauth
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
