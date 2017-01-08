<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/app.css">

    <title>@yield('title')</title>
  </head>
  <body>
    <div class="container">
      <p><a href="/">Terug naar Dashboard</a>@yield('navbar')<a href="#" class="pull-right">Logout</a></p>


          @yield('content')
    </div>

    <script>
      jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.document.location = $(this).data("href");
        });
      });
    </script>
  </body>
</html>
