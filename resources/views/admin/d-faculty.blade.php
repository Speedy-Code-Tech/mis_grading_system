@extends('layouts.main', ['title' => 'DASHBOARD', 'active' => 'dashboard'])

@section('content')
    <div class="w-100 h-100 p-5">
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="me-2" style="color: #A6DBD8; font-weight: 600;">Dashboard</h2>
            </a>
            <span style="color: #A6DBD8; font-size: 1.5rem;">/</span>
            <a href="{{ route('admin.dashboard.faculty') }}">
                <h2 class="ms-2" style="color: #33BA5C; font-weight: 600;">Faculty</h2>
            </a>
        </div>

        <div class="card-body bg-white p-4 shadow rounded">
            <table class="table table-hover">
                <thead>
                    <tr class="card-header">
                        <th class="p-2 px-4 text-white" style="background: #33BA5C">Faculty Names</th>
                        <th class="p-2 px-4 text-white" style="background: #33BA5C">Position</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($faculties as $faculty)
                        <tr>
                            <td class="bg-transparent p-2 px-4">{{ $faculty->fname }} {{ $faculty->lname }}</td>
                            <td class="bg-transparent p-2 px-4">{{ $faculty->department_type }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection