<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  </head>

  <body>
    <div class="container">
      @include('partials.navbar')
      <main>
        @yield('content')
      </main>
    </div>
  </body>

</html>
