<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - {{$title}}</title>
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body {
            width: 100vw;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div id="app" style="width:100%; height: 100%;">

        <main class="d-flex" style="width:100%; height: 100%;">

          
            @if(auth()->user()->role=='admin')
                @include('admin.partials.sidebar')
            @elseif(auth()->user()->role=='student')
                @include('student.partials.sidebar')
            @elseif(auth()->user()->role=='teacher')
                @include('teacher.partials.sidebar')
            @elseif(auth()->user()->role=='head_teacher')
                            @include('head.partials.sidebar')
            @endif

        
            <div class="container-fluid h-100 logo" style="background: url({{ asset('img/logo.jpg') }}); background-repeat: no-repeat;background-size: contain; background-position: center;   background-color: rgba(255,255,255,0.6);
    background-blend-mode: lighten;">
                @yield('content')
            </div>
        </main>
    </div>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
</body>

</html>