@extends('layouts.main', ['title' => 'DASHBOARD', 'active' => 'dashboard'])

@section('content')
    <div class="w-100 h-100 p-5">
        <h2 class="mb-3">DASHBOARD</h2>
        <div class="container-fluid d-flex gap-5 mb-4">
            <div class="container  d-flex align-items-center p-3" style="background:#F38384">
                <i class="bi bi-backpack2-fill h1 text-white"></i>
                <div class="container d-flex flex-column">
                    <h5 class="text-end">SEMESTER</h5>
                    <h1 class="fw-bold text-end">{{$semesterCount}}</h1>
                </div>
            </div>

            <div class="container  d-flex align-items-center p-3" style="background:#F5C4C3">
                <i class="bi bi-backpack2-fill h1 text-white"></i>
                <div class="container d-flex flex-column">
                    <h5 class="text-end">DEPARTMENT</h5>
                    <h1 class="fw-bold text-end">{{$departmentCount}}</h1>
                </div>
            </div>

            <div class="container  d-flex align-items-center p-3" style="background:#989BCC">
                <i class="bi bi-backpack2-fill h1 text-white"></i>
                <div class="container d-flex flex-column">
                    <h5 class="text-end">FACULTY</h5>
                    <h1 class="fw-bold text-end">{{$facultyCount}}</h1>
                </div>
            </div>


        </div>

        <div class="container-fluid d-flex gap-5 ">

            <div class="container  d-flex align-items-center p-3" style="background:#ECF0C4">
                <i class="bi bi-backpack2-fill h1 text-white"></i>
                <div class="container d-flex flex-column">
                    <h5 class="text-end">STUDENT</h5>
                    <h1 class="fw-bold text-end">{{$studentCount}}</h1>
                </div>
            </div>
            <div class="container  d-flex align-items-center p-3" style="background:#B6D4D4">
                <i class="bi bi-backpack2-fill h1 text-white"></i>
                <div class="container d-flex flex-column">
                    <h5 class="text-end">SUBJECT</h5>
                    <h1 class="fw-bold text-end">{{$subjectCount}}</h1>
                </div>
            </div>

            <div class="container bg-danger  d-flex align-items-center p-3" style="opacity:0;">
                <i class="bi bi-backpack2-fill h1 text-white"></i>
                <div class="container d-flex flex-column">
                    <h5 class="text-end">SUBJECT</h5>
                    <h1 class="fw-bold text-end">0</h1>
                </div>
            </div>
        </div>
    </div>
@endsection