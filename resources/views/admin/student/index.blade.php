@extends('layouts.main', ['title' => 'STUDENT', 'active' => 'student'])


@section('content')
    <div class="container pt-5 w-100">
        <div class="d-flex justify-content-between items-center mb-3">
            <div class="d-flex gap-3 items-center w-50">
                <h4 class="fw-semibold">STUDENT LIST</h4>
                <p class="m-0">Home - Student</p>
            </div>
            <div class="d-flex items-center gap-2">
                <form action="{{ route('student.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="excelImport" class="btn text-white" style="background:#007bff;">
                        <i class="bi bi-file-earmark-excel-fill"></i> Import Excel
                    </label>
                    <input type="file" id="excelImport" name="excel_file" accept=".xlsx, .xls" style="display: none;" onchange="this.form.submit()">
                </form>

                <a href="{{ route('student.create') }}" class="btn text-white addfaculty" style="background:#189993;">
                    <i class="bi bi-plus-lg"></i> Student
                </a>
            </div>

        </div>

        @if (session('msg'))
            <script>
                Swal.fire({
                    title: 'Successful',
                    text: "{{ session('msg') }}",
                    icon: 'success',
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    title: 'Error',
                    text: "{{ session('error') }}",
                    icon: 'error',
                });
            </script>
        @endif

        <div class="bg-white p-4 shadow rounded">
            <table id="studentTable" class="table table-hover table-white rounded">
                <thead>
                    <tr>
                        <th class="bg-transparent p-2 px-4">Student Name</th>
                        <th class="bg-transparent p-2">Age</th>
                        <th class="bg-transparent p-2">Email</th>
                        <th class="bg-transparent p-2">Strand</th>
                        <th class="bg-transparent p-2">Grade Level</th>
                        <th class="bg-transparent p-2">Section</th>
                        <th class="bg-transparent p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td class="bg-transparent p-2 px-4">{{ $student->fname . ' ' . $student->mname . ' ' . $student->lname}}</td>
                            <td class="bg-transparent p-2">{{ \Carbon\Carbon::parse($student->bdate)->age }} Y/o</td>
                            <td class="bg-transparent p-2">{{ $student->user->email }}</td>
                            <td class="bg-transparent p-2">{{ $student->department->course_code }}</td>
                            <td class="bg-transparent p-2">Grade - {{ $student->level }}</td>
                            <td class="bg-transparent p-2">{{ $student->section->name }}</td>
                            <td class="bg-transparent p-2">
                                <div class="d-flex justify-center gap-1" role="group">
                                    <a href="{{ route('admin.students.grades', $student->student_id) }}" class="btn btn-primary text-white">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </a>
                                    <a style="background: #189993; text-decoration: none" class="btn text-white text-white edit" href="{{ route('student.edit',$student->student_id) }}" id={{ $student->id }}> 
                                        <i class="bi bi-pencil-square"></i> 
                                    </a>
                                    <a href="{{ route('student.destroy', $student->id) }}" style="text-decoration: none" class="btn btn-danger">
                                        <i class="bi bi-trash3-fill"></i> 
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

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

        $(document).ready(function () {
            $('#studentTable').DataTable({
                responsive: true,
                paging: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25],
                searching: true,
                ordering: true,
                columnDefs: [
                    { orderable: false, targets: 4 }
                ],
                language: {
                    search: "Search Records:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No records available",
                    zeroRecords: "No matching records found",
                    paginate: {
                        previous: "Previous",
                        next: "Next"
                    }
                }
            });
        });
    </script>
@endsection