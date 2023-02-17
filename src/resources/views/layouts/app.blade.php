<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- NES.css 読み込み -->
  @vite(['resources/js/app.js'])

  <!-- 共通css -->
  <link href="{{ asset('/css/style.css') }}" rel="stylesheet" />
  <!-- 個別css -->
  @stack('styles')
  <!-- favicon -->
  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=DotGothic16&family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">

  <title>@yield('title')</title>

</head>

  <body>
    @include('conponents.header')
    <!-- 見出し -->
    <h2 class="section_title">@yield('section_title')</h2>
    <h2 class="section_title_responsive">@yield('section_title_responsive')</h2>
    <h2 class="section_title_subgoal">@yield('section_title_subgoal')</h2>
    @yield('content')
    @include('conponents.footer')
    <!-- js -->
    @stack('scripts')
  </body>

</html>