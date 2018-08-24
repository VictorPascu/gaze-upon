<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GazeUpon</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/listener.css') }}" rel="stylesheet">
</head>
<body>
<div class="flex-center position-ref full-height">

    <div id="vue-app">
        <gazeupon-listener feedname="{{$feedname}}"></gazeupon-listener>
    </div>


    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                    @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            GazeUpon
        </div>

        <div class="links">
            <a href="https://github.com/VictorPascu/gazeupon">GitHub</a>
        </div>
    </div>
</div>

<script src="https://player.vimeo.com/api/player.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
<script src="/js/app.js"></script>

<script>
    window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
</script>
</body>
</html>
