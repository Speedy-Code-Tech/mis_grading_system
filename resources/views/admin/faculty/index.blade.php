@extends('layouts.main', ['title' => 'FACULTY', 'active' => 'faculty'])

@section('content')
    <div class="container pt-5 w-100">
        <div class="d-flex justify-content-between items-center mb-3">
            <div class="d-flex gap-3 items-center w-50">
                <h4 class="fw-semibold">FACULTY LIST</h4>
                <p class="m-0">Home - Faculty</p>
            </div>
            <button class="btn text-white addfaculty" style="background: #189993" data-bs-toggle="modal" data-bs-target="#addFacultyModal">
                <i class="bi bi-plus-lg"></i> Add Faculty
            </button>
        </div>
        @if (session('msg'))
            <div class="alert alert-info mt-3">
                {{ session('msg') }}
            </div>
        @endif

        <div class="bg-white p-4 shadow rounded">
            <table id="teacherTable" class="table table-hover table-white rounded">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="p-2 px-4">Name</th>
                        <th class="p-2">Email</th>
                        <th class="p-2">Track</th>
                        <!-- <th class="p-2">Subject</th> -->
                        <th class="p-2">Status</th>
                        <th class="p-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($faculties as $faculty)
                        <tr class="align-middle">
                            <td class="p-2 px-4">{{ $faculty->fname . ' ' . $faculty->lname }}</td>
                            <td class="p-2">{{ $faculty->user->email }}</td>
                            <td class="p-2">{{ $faculty->department->course_code }}</td>
                            {{--  <td class="p-2">{{ $faculty->semester->name }}</td> --}}
                            <td class="p-2">
                                <span class="badge text-white {{ $faculty->status ? 'current-active' : 'current-inactive' }}">
                                    {{ $faculty->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="p-2 text-center">
                                <div class="" role="group">
                                    <button style="background: #189993;" class="btn text-white edit" id="{{ $faculty->id }}" data-bs-toggle="modal" data-bs-target="#editFacultyModal">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <a href="{{ route('faculty.destroy', $faculty->id) }}" class="btn btn-danger">
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

    <!-- Add Faculty Modal -->
    <div class="modal fade" id="addFacultyModal" tabindex="-1" aria-labelledby="addFacultyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFacultyModalLabel">Add Faculty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('faculty.store') }}" class="d-flex flex-column gap-3">
                        @csrf

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <label class="fw-bold">Status:</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status') ? 'checked' : '' }} style="transform: scale(1.2);">
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <label class="fw-bold">Full Name:</label>
                            <div class="col-md-4">
                                <input id="fname" value="{{ old('fname') }}" name="fname" required placeholder="First Name" type="text" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <input name="mname" id="mname" value="{{ old('mname') }}" placeholder="Middle Name" type="text" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <input name="lname" id="lname" required value="{{ old('lname') }}" placeholder="Last Name" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="fw-bold">Email</label>
                                @error('email')
                                    <span class="text-danger p" style="font-size:10px;">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                                <input value="{{ old('email') }}" type="email" name="email" id="email" required class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Password</label>
                                @error('password')
                                    <span class="text-danger p" style="font-size:10px;">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                                <input value="{{ old('password') }}" type="password" name="password" id="password" required class="form-control">
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="fw-bold">Semester</label>
                                @error('semester_id')
                                    <span class="text-danger p" style="font-size:10px;">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                                <select name="semester_id" id="semester_id" class="form-control">
                                    <option value="" disabled selected>Select a Semester</option>
                                    @foreach ($semesters as $sem)
                                        <option value="{{ $sem->id }}" {{ old('semester_id') == $sem->id ? 'selected' : '' }}>
                                            {{ $sem->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="fw-bold">Department</label>
                                @error('department_id')
                                    <span class="text-danger p" style="font-size:10px;">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                                <select name="department_id" id="department_id" class="form-control">
                                    <option value="" disabled selected>Select a Department</option>
                                    @foreach ($departments as $dept)
                                        <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                                            {{ $dept->course_code . ' - ' . $dept->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col">
                                <label class="fw-bold">Department Type</label>
                                @error('department_type')
                                    <span class="text-danger p" style="font-size:10px;">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                                <select name="department_type" id="department_type" class="form-control">
                                    <option value="" disabled selected>Select a Department Type</option>
                                    <option value="head_teacher" {{ old('department_type') == 'head_teacher' ? 'selected' : '' }}>Head Teacher</option>
                                    <option value="teacher" {{ old('department_type') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                                </select>
                            </div>
                        </div>

                        <div class="container mt-3">
                            <button type="submit" class="btn text-white form-control" style="background: #189993">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Faculty Modal -->
    <div class="modal fade" id="editFacultyModal" tabindex="-1" aria-labelledby="editFacultyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFacultyModalLabel">Edit Faculty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="editFacultyForm" action="" class="d-flex flex-column gap-3">
                        @csrf

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <label class="fw-bold">Status:</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status" type="checkbox" name="status" value="1"
                                        {{ old('status') ? 'checked' : '' }} style="transform: scale(1.2);">
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <label class="fw-bold">Full Name:</label>
                            <div class="col-md-4">
                                <input name="fname" required placeholder="First Name" type="text" class="form-control fname">
                            </div>
                            <div class="col-md-4">
                                <input name="mname" placeholder="Middle Name" type="text" class="form-control mname">
                            </div>
                            <div class="col-md-4">
                                <input name="lname" required placeholder="Last Name" type="text" class="form-control lname">
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="fw-bold">Email</label>
                                <input type="email" name="email" required class="form-control email">
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Password</label>
                                <input type="password" name="password" class="form-control password">
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="fw-bold">Semester</label>
                                <select name="semester_id" class="form-control semester_id">
                                    <option value="" disabled selected>Select a Semester</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="fw-bold">Department</label>
                                <select name="department_id" class="form-control department_id">
                                    <option value="" disabled selected>Select a Department</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col">
                                <label class="fw-bold">Department Type</label>
                                <select name="department_type" class="form-control department_type">
                                    <option value="" disabled selected>Select a Department Type</option>
                                    <option value="head_teacher">Head Teacher</option>
                                    <option value="teacher">Teacher</option>
                                </select>
                            </div>
                        </div>

                        <div class="container mt-3">
                            <button type="submit" class="btn text-white form-control" style="background: #189993">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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

        .current-active {
            background-color: #189993;
        }

        .current-inactive {
            background-color: red;
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
                if(data.faculties.status == 1){
                    $('.status')
                        .prop('checked', true)                  // set the checkbox state
                        .trigger('change');   
                }else{
                    $('#estatus')
                        .prop('checked', false)                  // set the checkbox state
                        .trigger('change');   
                }
                $('.email').val(data.faculties.user.email);
                $('.semester_id').val(data.faculties.semester[0].id).change();
                $('.department_id').val(data.faculties.department.id).change();
                $('.department_type').val(data.faculties.department_type).change();
                
                
                
                const form = $('#editFacultyForm');
                const action = `/admin/faculty/edit/${data.faculties.id}`;
                form.attr('action', action);
                $('.editfaculty').removeClass('d-none');
            });

        });

        $(document).ready(function () {
            $('#teacherTable').DataTable({
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