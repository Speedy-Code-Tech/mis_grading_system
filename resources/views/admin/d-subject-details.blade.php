@extends('layouts.main', ['title' => 'DASHBOARD', 'active' => 'dashboard'])

@section('content')
    <div class="w-100 h-100 p-5">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="" style="color: #A6DBD8; font-weight: 600;">Dashboard</h2>
            </a>
            <span style="color: #A6DBD8; font-size: 1.5rem;">/</span>
            <a href="{{ route('admin.dashboard.subject') }}">
                <h2 class="" style="color: #EA3865; font-weight: 600; opacity: 75%">Subject</h2>
            </a>
            <span style="color: #A6DBD8; font-size: 1.5rem;">/</span>
            <a href="">
                <h2 class="" style="color: #EA3865; font-weight: 600;">
                    Grade {{ $level }} - {{ $track }}
                </h2>
            </a>
        </div>

        <div class="card-body bg-white p-4 shadow rounded">
            <table class="table table-hover">
                <thead>
                    <tr class="card-header">
                        <th class="p-3 text-white" style="background: #EA3865">Subject Code</th>
                        <th class="p-3 text-white" style="background: #EA3865">Subject Descriptive Title</th>
                        <th class="p-3 text-white" style="background: #EA3865">No. of Hours</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($subjects as $subject)
                        <tr>
                            <td class="bg-transparent p-3">{{ $subject->subject_code }}</td>
                            <td class="bg-transparent p-3">{{ $subject->name }}</td>
                            <td class="bg-transparent p-3">{{ $subject->hrs }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection