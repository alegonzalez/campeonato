
@extends('layouts.app')

@section('content')
  <link rel="stylesheet" href="{{asset('css/fullcalendar.css')}}">
<link rel="stylesheet" href="{{asset('css/plugin_calendar.min.css')}}">
  <link rel="stylesheet" href="/css/calendar.css">
  <div id='calendar'></div>
  <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
  <script src='{{asset('js/moment_locale.min.js')}}'></script>
  <script src='{{asset('js/fullcalendar.min.js')}}'></script>
  <script src='{{asset('js/popup.min.js')}}'></script>
  <script  src="/js/script.js"></script>
  <script type="text/javascript" src="{{asset('js/calendar.js')}}"></script>
@endsection
