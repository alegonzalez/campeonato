        @extends('layouts.app')

        @section('content')
        <div class="card card_option col-md-5 offset-md-3" >
            
            <img src="{{ asset('img/cup.png') }}" class="rounded mx-auto d-block icon_cup" alt="...">
            <div class="card-body col-md-12">
                <form action="{{ route('storage') }}" method="post">
                    @csrf
                    <div class="form-group text-center">
                        <label for="name_championship">Nombre del torneo</label>
                        <input type="text" class="form-control" id="name_championship" name="name_championship">
                        <br>
                        <button class="btn btn-outline-primary setting_button btn-lg btn-block"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Crear</button>
                      </div>
                </form>
            </div>
            </div> 
        @endsection