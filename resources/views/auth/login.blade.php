@extends('layouts.app')
<style>
    .logo {
        border-radius: 50%;
    }
</style>

<?php $prefix = request()->route()->getPrefix(); ?>
@php
    $value = "";

    $name="";
    if ($prefix == '/student') {
        $value = 'student';
        $name = "Student";
    } else if ($prefix == '/admin') {
        $value = 'admin';
        $name = "Administrator";
    } else if ($prefix == '/teacher') {
        $value = 'teacher';
        $name = "Teacher";
    } else if ($prefix == '/head') {
        $value = 'head_teacher';
        $name = "Head Teacher";
    }

@endphp
@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center flex-column h-100">
        <div class="container d-flex justify-content-center align-items-center flex-column mt-5">
            <img class="img-fluid logo" src="{{ asset('img/logo.jpg') }}" />
            <h1 class="fw-bold">Moreno Integrated School</h2>
                <h3>Online Grading System</h3>
        </div>
        <br />
        <h5 class="fw-bold">{{ $name }} Login</h3>
            @if (session('msg'))
                <div class="alert {{ session('error') ? 'alert-success' : 'alert-danger' }}">
                    {{ session('msg') }}
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}" class="mt-3">
                @csrf

                <input type="hidden" name="role" id="" value="{{$value }}">
                <div class="row mb-3 ">
                    <label for="email" class="fw-bold">{{ __('Email Address') }}</label>

                    <div class="col">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-1">
                    <label for="password" class="fw-bold">{{ __('Password') }}</label>

                    <div class="col">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col text-end">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}" style="color:#189993">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col">
                        <button type="submit" class="btn form-control" style="background:#189993; color:whitesmoke">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>
            </form>
            <!-- <a href="{{ $prefix == '/admin' ? '/student' : '/admin' }}/login" class="h5 mt-3"
                style="text-decoration: none; color:grey; font-weight: 600">{{ $prefix == '/admin' ? 'Student' : 'Administrator' }}
                Login</a> -->

            <div class="mt-3 d-flex flex-column gap-3 items-center">
                @php
                    $roles = [
                        'admin' => 'Administrator',
                        'student' => 'Student',
                        'teacher' => 'Teacher',
                        'head' => 'Head Teacher',
                    ];
                @endphp

                @foreach ($roles as $role => $label)
                    @if ($prefix !== '/' . $role)
                        <a href="/{{ $role }}/login"
                            class="h5 text-center"
                            style="text-decoration: none; color:grey; font-weight: 600"
                        >
                            {{ $label }} Login
                        </a>
                    @endif
                @endforeach
            </div>


    </div>
@endsection