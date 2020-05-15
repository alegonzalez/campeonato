
@extends('layouts.app')

@section('content')
  <link rel='stylesheet' href='https://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.css'>
  <link rel='stylesheet' href='https://dimsemenov.com/plugins/magnific-popup/site-assets/all.min.css?v=0.9.9'><link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="/css/calendar.css">
  <div id='calendar'></div>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js'></script>
  <script src='https://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery.min.js'></script>
  <script src='https://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>
  <script src='https://dimsemenov.com/plugins/magnific-popup/dist/jquery.magnific-popup.min.js?v=0.9.9'></script>
  <script  src="/js/script.js"></script>
  <script type="text/javascript" src="{{asset('js/calendar.js')}}"></script>
@endsection
