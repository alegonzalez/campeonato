@extends('layouts.app')

@section('content')
  <script src="{{ asset('js/breach.js') }}" defer></script>
  @auth
    <div class="offset-md-12">
      <a href="{{ route('breach/create',['id_championship' => $id_championship] ) }}" class="btn btn-outline-primary setting_button btn-lg btn-block"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Crear</a>
    </div>
  @if(count($breaches) > 0)
      <div class="table-responsive-md col-md-12">
        <table id="dtBasicExample" class="table table-striped table-bordered table-hover table-md col-md-12" cellspacing="0" width="100%">
          <thead>
            <tr class="text-center">
              <th class="th-md text-center">Número
              </th>
              <th class="th-md text-center">Nombre del jugador
              </th>
              <th class="th-md text-center">Tarjetas Amarillas
              </th>
              <th class="th-md text-center">Tarjetas Rojas
              </th>
              <th class="th-md text-center">Editar
              </th>
              <th class="th-md text-center">Eliminar
              </th>
            </tr>
          </thead>
          <tbody>
            <?php $cont = 0; ?>
            @foreach ($breaches as $breach)
              <?php $cont += 1; ?>
              <tr class="text-center">
                <th scope="row">{{$cont}}</th>
                <td>{{$breach->name}}</td>
                <td>{{$breach->yellow_card}}</td>
                <td>{{$breach->red_card}}</td>
                <td><a href="{{ route('breach/edit',['id_breach' =>$breach->id] ) }}" class="btn btn-outline-success  "><i class="fa fa-pencil" aria-hidden="true"></i> </a></td>
                <td>
                  <form action="{{ route('breach/destroy',['id_breach' =>$breach->id] )}}" method="POST" id="form_{{$breach->id}}">
                    @method('DELETE')
                    @csrf
                    <button type="button"  class="btn btn-outline-danger" onclick="destroy_breach('{{$breach->id}}','{{$breach->name}}');" >
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <br><br><br><br>
      <div class="col-md-12 text-center">

        <h1>No se encuentra ningún registro</h1>
      </div>
    @endif
  @endauth
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection
