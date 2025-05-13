@extends('layouts.main', ['title' => 'DASHBOARD', 'active' => 'dashboard'])

@section('content')
    <div class="w-100 h-100 p-5">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="" style="color: #A6DBD8; font-weight: 600;">Dashboard</h2>
            </a>
            <span style="color: #A6DBD8; font-size: 1.5rem;">/</span>
            <a href="{{ route('admin.dashboard.student') }}">
                <h2 class="" style="color: #E9D819; font-weight: 600; opacity: 75%">Student</h2>
            </a>
            <span style="color: #A6DBD8; font-size: 1.5rem;">/</span>
            <a href="">
                <h2 class="" style="color: #E9D819; font-weight: 600;">
                    Grade {{ $level }} - {{ $track }}
                </h2>
            </a>
        </div>

        <div class="card-body bg-white p-4 shadow rounded">
            <table class="table table-hover">
                <thead>
                    <tr class="card-header">
                        <th class="p-2 px-4 text-white" style="background: #E9D819">Student ID</th>
                        <th class="p-2 px-4 text-white" style="background: #E9D819">Student Name</th>
                        <th class="p-2 px-4 text-white" style="background: #E9D819">Section</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($students as $student)
                        <tr>
                            <td class="bg-transparent p-2 px-4">{{ $student->student_id }}</td>
                            <td class="bg-transparent p-2 px-4">{{ $student->fname }} {{ $student->lname }}</td>
                            <td class="bg-transparent p-2 px-4">{{ $student->section->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection