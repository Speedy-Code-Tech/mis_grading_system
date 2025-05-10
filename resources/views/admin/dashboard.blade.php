@extends('layouts.main', ['title' => 'DASHBOARD', 'active' => 'dashboard'])

@section('content')
    <div class="w-100 h-100 p-5">
        <h2 class="mb-5" style="color: #189993">DASHBOARD</h2>
        
        <!-- First Row -->
        <div class="d-flex gap-4 mb-4">
            <div class="container d-flex align-items-center p-3 text-white rounded" style="background:#37B6C4; height: 120px; cursor: pointer;">
                <i class="bi bi-calendar2-week h1 text-white me-3"></i>
                <div class="d-flex flex-column w-100">
                    <h5 class="text-end m-0">SEMESTER</h5>
                    <h1 class="fw-bold text-end m-0">{{ $semesterCount }}</h1>
                </div>
            </div>

            <div class="container d-flex align-items-center p-3 text-white rounded" style="background:#2874B3; height: 120px; cursor: pointer;">
                <i class="bi bi-diagram-3 h1 text-white me-3"></i>
                <div class="d-flex flex-column w-100">
                    <h5 class="text-end m-0">DEPARTMENT</h5>
                    <h1 class="fw-bold text-end m-0">{{ $departmentCount }}</h1>
                </div>
            </div>

            <div class="container d-flex align-items-center p-3 text-white rounded" style="background:#33BA5C; height: 120px; cursor: pointer;">
                <i class="bi bi-backpack2-fill h1 text-white me-3"></i>
                <div class="d-flex flex-column w-100">
                    <h5 class="text-end m-0">FACULTY</h5>
                    <h1 class="fw-bold text-end m-0">{{ $facultyCount }}</h1>
                </div>
            </div>
        </div>

        <!-- Second Row (Centered) -->
        <div class="d-flex gap-4 justify-content-center">
            <div class="d-flex align-items-center p-3 text-white rounded" style="background:#E9D819; width: 350px; height: 120px; cursor: pointer;">
                <i class="bi bi-backpack2-fill h1 text-white me-3"></i>
                <div class="d-flex flex-column w-100">
                    <h5 class="text-end m-0">STUDENT</h5>
                    <h1 class="fw-bold text-end m-0">{{ $studentCount }}</h1>
                </div>
            </div>

            <div class="d-flex align-items-center p-3 text-white rounded" style="background:#EA3865; width: 350px; height: 120px; cursor: pointer;">
                <i class="bi bi-backpack2-fill h1 text-white me-3"></i>
                <div class="d-flex flex-column w-100">
                    <h5 class="text-end m-0">SUBJECT</h5>
                    <h1 class="fw-bold text-end m-0">{{ $subjectCount }}</h1>
                </div>
            </div>
        </div>

    </div>
@endsection