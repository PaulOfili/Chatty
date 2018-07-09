<!DOCTYPE html>
<html lang="en" id = "bomb">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chatty</title>

     {{-- <link href = "{{ asset('css/app.css') }}" rel = "stylesheet"> --}}
     <!-- Latest compiled and minified CSS -->
     <link href = "{{ asset('css/bootstrap.min.css') }}" rel = "stylesheet">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
     
    
</head>
<body>

    @include ('templates.partials.navigation')
    <div class="container">
        @include ('templates.partials.alerts')
        @yield('content')
    </div>
</body>
</html>

