@extends('layouts.main', ['title' => 'DASHBOARD', 'active' => 'dashboard'])

@section('content')
    <div class="w-100 h-100 p-5">
        <a href="{{ route('admin.dashboard') }}">
            <h2 class="mb-5" style="color: #189993; font-weight: 600;">Dashboard</h2>
        </a>
        
        <!-- First Row -->
        <div class="d-flex gap-4 mb-4">
            <a href="{{ route('admin.dashboard.strand') }}" class="container d-flex align-items-center p-5 text-white rounded" style="background:#2874B3; height: 120px; cursor: pointer; text-decoration: none">
                <!-- <i class="bi bi-diagram-3 h1 text-white me-3"></i> -->
                <img src="{{ asset('img/social-network1.png') }}" alt="strand" width="70">
                <div class="d-flex flex-column w-100">
                    <h5 class="text-end m-0">STRAND</h5>
                    <h1 class="fw-bold text-end m-0">{{ $departmentCount }}</h1>
                </div>
            </a>

            <a href="{{ route('admin.dashboard.faculty') }}" class="container d-flex align-items-center p-5 text-white rounded" style="background:#33BA5C; height: 120px; cursor: pointer; text-decoration: none">
                <img src="{{ asset('img/student1.png') }}" alt="faculty" width="70">
                <div class="d-flex flex-column w-100">
                    <h5 class="text-end m-0">FACULTY</h5>
                    <h1 class="fw-bold text-end m-0">{{ $facultyCount }}</h1>
                </div>
            </a>
        </div>

        <!-- Second Row (Centered) -->
        <div class="d-flex gap-4 justify-content-center">
            <a href="{{ route('admin.dashboard.student') }}" class="container d-flex align-items-center p-5 text-white rounded" style="background:#E9D819; height: 120px; cursor: pointer; text-decoration: none">
                <img src="{{ asset('img/reading-book1.png') }}" alt="student" width="70">
                <div class="d-flex flex-column w-100">
                    <h5 class="text-end m-0">STUDENT</h5>
                    <h1 class="fw-bold text-end m-0">{{ $studentCount }}</h1>
                </div>
            </a>

            <a href="{{ route('admin.dashboard.subject') }}" class="container d-flex align-items-center p-5 text-white rounded" style="background:#EA3865; height: 120px; cursor: pointer; text-decoration: none">
                <img src="{{ asset('img/book1.png') }}" alt="subject" width="70">
                <div class="d-flex flex-column w-100">
                    <h5 class="text-end m-0">SUBJECT</h5>
                    <h1 class="fw-bold text-end m-0">{{ $subjectCount }}</h1>
                </div>
            </a>
        </div>

    </div>
@endsection