@extends('layouts.app')
<style>
    .left {
        background-repeat: no-repeat;
        background-size: cover;
    }

    .right {
        background: white;
    }

    .logo {
        background:url('/img/logo.jpg');
        background-repeat: no-repeat;
        background-size: contain; 
        background-position: center;   
        background-color: rgba(255,255,255,0.89);
        background-blend-mode: lighten;
    }
</style>
@section('content')
    @if (session('msg'))
        <script>
            Swal.fire({
                title: 'Successful',
                text: "{{ session('msg') }}",
                icon: 'success',
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Error',
                text: "{{ session('error') }}",
                icon: 'error',
            });
        </script>
    @endif
    <div class="d-flex justify-content-center align-items-center h-100" style="overflow-y: hidden">
        <div class="left container h-100 d-flex justify-content-center align-items-center logo">
            <div style="width:90%"
                class="container border rounded bg-white  d-flex flex-column justify-content-center align-items-center p-5 gap-3">
                <h2 style="color:#189993" class="text-center fw-bold">Moreno Integrated <br> School</h2>
                <div class="container d-flex">
                    <div id="check"
                        class="border rounded bg-primary d-flex justify-content-enter align-items-center text-white pt-3 p-3 h5 ">
                        <h5 class="fw-bold p-0 m-0">1</h5>
                    </div>
                    <div style="background:rgb(211, 211, 211)" id="check1"
                        class="border rounded  d-flex justify-content-enter align-items-center text-white pt-3 p-3 h5 ">
                        <h5 class="fw-bold p-0 m-0"><img style="width:15px; height:15px;"
                                src="{{ asset('img/check.png') }}" /></h5>
                    </div>
                    <div class="container ms-4">
                        <h3 class="mb-0">Registration Type</h3>
                        <h5 class="text-secondary">Setup your Registration Type</h5>
                    </div>
                </div>
                <div class="container d-flex">
                    <div id='check2grey' style="background:rgb(211, 211, 211)"
                        class="border rounded d-flex justify-content-enter align-items-center text-primary pt-3 p-3 h5 ">
                        <h5 class="fw-bold p-0 m-0">2</h5>
                    </div>
                    <div id='check2blue'
                        class="border bg-primary rounded d-flex justify-content-enter align-items-center text-primary pt-3 p-3 h5 ">
                        <h5 class="fw-bold p-0 m-0 text-white">2</h5>
                    </div>
                    <div style="background:rgb(211, 211, 211)" id="check2check"
                        class="border rounded  d-flex justify-content-enter align-items-center text-white pt-3 p-3 h5 ">
                        <h5 class="fw-bold p-0 m-0"><img style="width:15px; height:15px;"
                                src="{{ asset('img/check.png') }}" /></h5>
                    </div>
                    <div class="container ms-4">
                        <h3 class="mb-0">Registration Info</h3>
                        <h5 class="text-secondary">Setup your Student Information</h5>
                    </div>
                </div>
                <div class="container d-flex">
                    <div id='check3grey' style="background:rgb(211, 211, 211)"
                        class="border rounded d-flex justify-content-enter align-items-center text-primary pt-3 p-3 h5 ">
                        <h5 class="fw-bold p-0 m-0">3</h5>
                    </div>
                    <div id='check3blue'
                        class="border bg-primary rounded d-flex justify-content-enter align-items-center text-primary pt-3 p-3 h5 ">
                        <h5 class="fw-bold p-0 m-0 text-white">3</h5>
                    </div>
                    <div style="background:rgb(211, 211, 211)" id="check3check"
                        class="border rounded  d-flex justify-content-enter align-items-center text-white pt-3 p-3 h5 ">
                        <h5 class="fw-bold p-0 m-0"><img style="width:15px; height:15px;"
                                src="{{ asset('img/check.png') }}" /></h5>
                    </div>
                    <div class="container ms-4">
                        <h3 class="mb-0">Account Info</h3>
                        <h5 class="text-secondary">Setup your Account Information</h5>
                    </div>
                </div>
                <div class="container d-flex">
                    <div id='check4grey' style="background:rgb(211, 211, 211)"
                        class="border rounded d-flex justify-content-enter align-items-center text-primary pt-3 p-3 h5 ">
                        <h5 class="fw-bold p-0 m-0">4</h5>
                    </div>
                    <div id='check4blue'
                        class="border bg-primary rounded d-flex justify-content-enter align-items-center text-primary pt-3 p-3 h5 ">
                        <h5 class="fw-bold p-0 m-0 text-white">4</h5>
                    </div>
                    <div style="background:rgb(211, 211, 211)" id="check4check"
                        class="border rounded  d-flex justify-content-enter align-items-center text-white pt-3 p-3 h5 ">
                        <h5 class="fw-bold p-0 m-0"><img style="width:15px; height:15px;"
                                src="{{ asset('img/check.png') }}" /></h5>
                    </div>
                    <div class="container ms-4">
                        <h3 class="mb-0">Residential Info</h3>
                        <h5 class="text-secondary">Setup your Residential Information</h5>
                    </div>
                </div>
                <div class="container d-flex">
                    <div id='check5grey' style="background:rgb(211, 211, 211)"
                        class="border rounded d-flex justify-content-enter align-items-center text-primary pt-3 p-3 h5 ">
                        <h5 class="fw-bold p-0 m-0">5</h5>
                    </div>
                    <div id='check5blue'
                        class="border bg-primary rounded d-flex justify-content-enter align-items-center text-primary pt-3 p-3 h5 ">
                        <h5 class="fw-bold p-0 m-0 text-white">5</h5>
                    </div>
                    <div style="background:rgb(211, 211, 211)" id="check5check"
                        class="border rounded  d-flex justify-content-enter align-items-center text-white pt-3 p-3 h5 ">
                        <h5 class="fw-bold p-0 m-0"><img style="width:15px; height:15px;"
                                src="{{ asset('img/check.png') }}" /></h5>
                    </div>
                    <div class="container ms-4">
                        <h3 class="mb-0">Complete</h3>
                        <h5 class="text-secondary">Your Registration has ben complete</h5>
                    </div>
                </div>


            </div>
        </div>

        <div class="right container h-100 d-flex flex-column justify-content-center align-items-center">
            <form method="POST" class="container-fluid" action="{{ route('registration') }}">
                @csrf
                @include('auth.partials.type')
                @include('auth.partials.student_info')
                @include('auth.partials.account_info')
                @include('auth.partials.resident_info')
            </form>
        </div>


        <script src="{{ asset('js/register.js') }}"></script>
        <style>
            /* Define the default border and background color for options */
            .option {
                border: 2px solid #ccc;
                background-color: #fff;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            /* Define the 'selected' class to change background color */
            .option.selected {
                background-color: #189993;
                color: white;
            }

            /* Optional: Change text color of 'selected' option */
            .option.selected h4 {
                color: white;
            }

            /* Define the 'selected' class to change background color */
            .level.selected {
                background-color: #189993;
                color: white;
            }

            .selected {
                background-color: #189993;
                color: white;
            }

            .selected p {
                color: white;
            }

            .strand {
                cursor: pointer;
            }
        </style>

    </div>
    {{-- END OF REGISTRATION TYPE --}}
@endsection