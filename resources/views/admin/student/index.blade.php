@extends('layouts.main', ['title' => 'STUDENT', 'active' => 'student'])


@section('content')
    <div class="container pt-5 w-100">
        <div class="d-flex gap-5 align-items-center">
            <h4>STUDENT LIST</h4>
            <p class="m-0">Home - Student</p>
        </div>
        <div class="container-fluid d-flex justify-content-end">
            <a href="{{ route('student.create') }}" class="btn btn-success addfaculty"><i class="bi bi-plus-lg"></i> Add Student</a>
        </div>
        @if (session('msg'))
            <div class="alert alert-info mt-3">
                {{ session('msg') }}
            </div>
        @endif

        <table id="myTable" class="table table-hover table-white rounded">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Strand</th>
                    <th>Grade Level</th>
                    <th>Section</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($students as $student)
                    <tr>
                        <td>{{$student->fname . ' ' . $student->mname . ' ' . $student->lname}}</td>
                        <td>{{\Carbon\Carbon::parse($student->bdate)->age}} Y/o</td>
                        <td>{{$student->user->email}}</td>
                        <td>{{$student->strand }}</td>
                        <td>Grade - {{$student->level}}</td>
                        <td>{{$student->section}}</td>
                        
                        <td>
                            <div class="conatiner-fluid d-flex gap-2">
                                <a style="text-decoration: none" class="btn edit" href="{{ route('student.edit',$student->id) }}" id={{ $student->id }}> <i
                                        class="text-warning bi bi-pencil-square"></i> </a>
                                <a href="{{ route('student.destroy', $student->id) }}" style="text-decoration: none"
                                    class="btn">
                                    <i class="text-danger bi bi-trash3-fill"></i> </a>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- ADD NEW FACULTY --}}
        {{-- @include('admin.faculty.add') --}}
        {{-- EDIT A FACULTY --}}
        {{-- @include('admin.faculty.edit') --}}




    </div>
    <style>
        .faculty,
        .editfaculty {
            background: white;
            width: 40%;
            position: absolute;
            top: 50%;
            left: 50%;
            padding-bottom: 20px;
            transform: translate(-50%, -50%);
            overflow-y: scroll;

        }
    </style>
    <script>
        $(document).ready(() => {
            $(".addfaculty").click(() => {
                $(".faculty").removeClass('d-none')
            })

            $(".close").click(() => {
                $(".faculty").addClass('d-none')
                $(".editfaculty").addClass('d-none')
            })

            $(".efaculty").click(() => {
                $(".editfaculty").addClass('d-none')
            })

            $('.edit').click(async function () {

                const id = $(this).attr('id');
                const response = await fetch(`/admin/faculty/edit/${id}`, {
                    headers: { 'Accept': 'application/json' }
                });

                if (!response.ok) {
                    throw new Error(`Server error: ${response.status}`);
                }

                const datas = await response.json(); 
                const data = datas
                console.log('Faculty data:', data);
                $('.fname').val(data.faculties.fname);
                $('.mname').val(data.faculties.mname);
                $('.lname').val(data.faculties.lname);
                if(data.faculties.status=='active'){
                    $('.status')
                        .prop('checked', true)                  // set the checkbox state
                        .trigger('change');   
                }else{
                    $('#estatus')
                        .prop('checked', false)                  // set the checkbox state
                        .trigger('change');   
                }
                $('.email').val(data.faculties.user.email);
                $('.semester_id').val(data.faculties.semester.id).change();
                $('.department_id').val(data.faculties.department.id).change();
                $('.department_type').val(data.faculties.department_type).change();
                
                
                
                const form = $('#editFacultyForm');
                const action = `/admin/faculty/edit/${data.faculties.id}`;
                form.attr('action', action);
                $('.editfaculty').removeClass('d-none');
            });

        });
    </script>
@endsection