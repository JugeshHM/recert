<!DOCTYPE html>
<html>
  <head>
    <title>Recert - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet" type="text/css" />
    <link href="/css/app.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <header> @include('layouts.header') </header>
    <div class="container-fluid">
      <div class="row-fluid contents"> @yield('content') </div>
    </div>
    <footer class="container-fluid"> @include('layouts.footer') </footer>
  </body>
</html>
