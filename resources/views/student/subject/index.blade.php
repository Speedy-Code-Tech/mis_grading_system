@extends('layouts.main', ['title' => 'SUBJECT', 'active' => 'subject'])


@section('content')
<div class="container pt-5 w-100">
    <div class="d-flex gap-5 align-items-center">
        <h4>SUBJECT LIST</h4>
        <p class="m-0">Home - Subject</p>
    </div>
    <div class="container-fluid d-flex justify-content-end">

    </div>
    @if (session('msg'))
        <div class="alert alert-info mt-3">
            {{ session('msg') }}
        </div>
    @endif

    <table id="myTable" class="table table-hover table-white rounded">
        <thead>
            <tr>
                <th>Semester</th>
                <th>Instructor</th>
                <th>Name</th>
                <th>Track</th>
                <!-- <th>Grades</th> -->
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject )
            <tr>
                <td>{{ $subject->subjectTeacher->semester->name ?? 'N/A' }}</td>
                <td>{{ $subject->subjectTeacher->faculty->fname ?? '' }} {{ $subject->subjectTeacher->faculty->lname ?? '' }}</td>
                <td>{{ $subject->subjectTeacher->subject->name ?? 'N/A' }}</td>
                <td>{{ $subject->subjectTeacher->subject->department->course_code ?? 'N/A' }}</td>
                <td><a href="#" class="btn text-primary"><i class="bi bi-eye-fill"></i> ECR</a></td>
            </tr>   
            @endforeach

        </tbody>
    </table>


</div>

@endsection