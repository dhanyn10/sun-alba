<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{env('APP_NAME')}}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{url('/css/style.css')}}">
    </head>
    <body>
        <!-- As a heading -->
        <nav class="navbar mb-2 bg-light">
            <div class="container-fluid">
            <a class="navbar-brand mb-0 h1" href="{{route('blogview')}}">{{env('APP_NAME')}}</a>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>