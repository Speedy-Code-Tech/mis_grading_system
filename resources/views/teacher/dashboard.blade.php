@extends('layouts.main',['title'=>'DASHBOARD','active'=>'dashboard'])

@section('content')
    <div class="w-100 h-100 p-5">
        <h2 class="mb-3">DASHBOARD</h2>
        <div class="container-fluid d-flex gap-5">
            <div class="container bg-primary d-flex align-items-center p-3">
                <i class="bi bi-backpack2-fill h1 text-white"></i>
                <div class="container d-flex flex-column">
                    <h5 class="text-end">STUDENTS</h5>
                    <h1 class="fw-bold text-end">{{$studentCount}}</h1>
                </div>
            </div>
         
            <div class="container bg-danger  d-flex align-items-center p-3">
                   <i class="bi bi-backpack2-fill h1 text-white"></i>
                <div class="container d-flex flex-column">
                    <h5 class="text-end">SUBJECT</h5>
                    <h1 class="fw-bold text-end">{{$count}}</h1>
                </div>
            </div>
        </div>
    </div>
@endsection