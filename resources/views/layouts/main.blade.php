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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        * {
            user-select: none;
        }

        body {
            width: 100vw;
            height: 100vh;
        }

        a{
            color:whitesmoke;
        }

        .active{
            color:#17908B;
            background: whitesmoke;
        }

        
        .background {
            background: url('/img/logo.jpg'); 
            background-repeat: no-repeat;
            background-size: contain; 
            background-position: center;   
            background-color: rgba(255,255,255,0.89);
            background-blend-mode: lighten;
        }
    </style>
</head>

<body>
    <div id="app" style="width:100%; height: 100vh;">

        <main class="d-flex" style="width:100%; min-height: 100vh;">

            <!-- Sidebar -->
            <!-- Sidebar -->
            <div class="sticky-top" style="position: sticky; top: 0; height: 100vh; z-index: 1050;">
                <div class="h-100 d-flex flex-column" style="width:250px; background: #17908B;"> <!-- Adjust sidebar width -->
                    @if(auth()->user()->role=='admin')
                        @include('admin.partials.sidebar')
                    @elseif(auth()->user()->role=='student')
                        @include('student.partials.sidebar')
                    @elseif(auth()->user()->role=='teacher')
                        @include('teacher.partials.sidebar')
                    @elseif(auth()->user()->role=='head_teacher')
                        @include('head.partials.sidebar')
                    @endif
                </div>
            </div>

            <!-- Dynamic Main Content -->
            <div class="container-fluid background">
                @yield('content')
            </div>

        </main>
    </div>
    

    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>