<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <title>App Name - @yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css"
        integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns"
        crossorigin="anonymous">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

@include ('layout.adminLayout.admin_header')

<div id="wrapper">
  @include ('layout.adminLayout.admin_sidebar')
  <main id="page-content-wrapper" role="main">
    @yield('content')
  </main>
  @include ('layout.adminLayout.admin_footer')
</div>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
