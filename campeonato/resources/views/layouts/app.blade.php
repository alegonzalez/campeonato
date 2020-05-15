<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>











  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">



  <!-- Scripts
  <script src="https://use.fontawesome.com/c3d5f77dc9.js"></script>
-->

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('js/alert_sweet.js') }}" defer></script>



</head>
<body>
  <div id="app">
    <nav class="navbar  navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('img/soccer.png') }}" alt="">{{ config('app.name', 'Laravel') }}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav w-100">

          <li class="nav-item active">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }} <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('share') }}">Compartir</a>
          </li>
          @auth
            <li class="nav-item dropdown ml-auto">
              <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->name }} <span class="caret"></span></a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Editar información</a>
                <a class="dropdown-item" href="{{ route('logout') }}" > Logout</a>
              </div>
            </li>
          @endauth
        </div>
      </nav>
      <main class="py-4">
        <div class="container">
          <div class="row">
            @include('sweet::alert')
            @yield('content')
          </div>
        </div>
</main>
    </div>
  </body>
  </html>
