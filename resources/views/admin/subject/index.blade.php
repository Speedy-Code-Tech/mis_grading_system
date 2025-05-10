@extends('layouts.main', ['title' => 'SUBJECT', 'active' => 'subject'])


@section('content')
    <div class="container pt-5 w-100">
        <div class="d-flex justify-content-between items-center mb-3">
            <div class="d-flex gap-3 items-center w-50">
                <h4 class="fw-semibold">SUBJECT</h4>
                <p class="m-0">Home - Subject</p>
            </div>
            <button style="background: #189993" class="btn text-white addsubject" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
                <i class="bi bi-plus-lg"></i> Subject
            </button>
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

        <div class="bg-white p-4 shadow rounded">
            <table id="subjectTable" class="table table-hover table-white rounded">
                <thead>
                    <tr>
                        <th class="bg-transparent p-2 px-4">Code</th>
                        <th class="bg-transparent p-2">Subject Name</th>
                        <th class="bg-transparent p-2">Grade Level</th>
                        <th class="bg-transparent p-2">No. of Hours</th>
                        <th class="bg-transparent p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $subject)
                        <tr>
                            <td class="bg-transparent p-2 px-4">{{ $subject->subject_code }}</td>
                            <td class="bg-transparent p-2">{{ $subject->name }}</td>
                            <td class="bg-transparent p-2">Grade {{ $subject->level }}</td>
                            <td class="bg-transparent p-2">{{ $subject->hrs }} hrs</td>
                            <td class="bg-transparent p-2">
                                <div class="d-flex justify-center gap-1" role="group">
                                    <button class="btn btn-warning text-white assign-teacher" data-id="{{ $subject->id }}" data-bs-toggle="modal" data-bs-target="#assignTeacherModal">
                                        <i class="bi bi-person-plus-fill"></i>
                                    </button>
                                    <button style="background: #189993;" class="btn text-white edit" data-id="{{ $subject->id }}" data-bs-toggle="modal" data-bs-target="#editSubjectModal">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <a href="{{ route('subject.destroy', $subject->id) }}" class="btn btn-danger">
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
        {{-- @include('admin.subject.add') --}}
        
        {{-- EDIT A FACULTY --}}
        {{-- @include('admin.subject.edit') --}}

    </div>
        
    <!-- Assign Teacher Modal -->
    <div class="modal fade" id="assignTeacherModal" tabindex="-1" aria-labelledby="assignTeacherModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignTeacherModalLabel">Assign Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('assign-subjects.store') }}" class="d-flex flex-column gap-3">
                        @csrf
                        <div class="container">
                            <label class="fw-bold">Subject Name</label>
                            @error('name')
                                <span class="text-danger p" style="font-size:10px;">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                            <select name="subject_id" id="subject_id" class="form-control">
                                <option value="" class="form-control" disabled selected >Select a Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }} class="form-control">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="container">
                            <label class="fw-bold">Instructor</label>
                            @error('instructor')
                                <span class="text-danger p" style="font-size:10px;">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                            <select name="faculty_id" id="faculty_id" class="form-control">
                                <option value="" class="form-control" disabled selected >Select an Instructor</option>
                                @foreach ($faculties as $faculty)
                                    <option value="{{ $faculty->id }}" {{ old('faculty_id')==$faculty->id?'selected':''}} class="form-control">{{$faculty->fname.' '.$faculty->mname.' '.$faculty->lname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="container">
                            <label class="fw-bold">Semester</label>
                            @error('semester')
                                <span class="text-danger p" style="font-size:10px;">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                            <select name="semester_id" id="semester_id" class="form-control">
                                <option value="" class="form-control" disabled selected >Select a Semester</option>
                                @foreach ($semesters as $semester)
                                    <option value="{{ $semester->id }}" {{ old('semester_id') == $semester->id? 'selected' : '' }} class="form-control">{{ $semester->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="container">
                            <label class="fw-bold">Grade Level</label>
                            @error('semester_id')
                                <span class="text-danger p" style="font-size:10px;">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                            <select name="level" id="level" class="form-control">
                                <option value="" class="form-control" disabled selected >Select a Level</option>
                                    <option value="11" {{ old('level')==11?'selected':''}} class="form-control">Grade 11</option>
                                    <option value="12" {{ old('level')==12?'selected':''}} class="form-control">Grade 12</option>
                            </select>
                        </div>
                        <div class="container">
                            <label class="fw-bold">Track</label>
                            @error('department_id')
                                <span class="text-danger p" style="font-size:10px;">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                            <select name="department_id" id="department_id" class="form-control">
                                <option value="" class="form-control" disabled selected>Select a Track</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept->id }}" class="form-control"  {{ old('department_id')==$dept->id?'selected':''}}>
                                        {{$dept->course_code . ' - ' . $dept->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="container">
                            <label class="fw-bold">Section</label>
                            @error('section')
                                <span class="text-danger p" style="font-size:10px;">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                            <select name="section_id" id="section_id" class="form-control">
                                <option value="" class="form-control" disabled selected >Select a Section</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}" {{ old('section_id') == $semester->id? 'selected' : '' }} class="form-control">{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="container">
                            <button type="submit" class="btn text-white form-control" style="background: #189993">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Subject Modal -->
    <div class="modal fade" id="editSubjectModal" tabindex="-1" aria-labelledby="editSubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubjectModalLabel">Edit Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form method="POST" id="editSubjectForm" class="d-flex flex-column gap-3">
                    @csrf
                    <div class="container">
                        <label class="fw-bold">Subject Code</label>
                            @error('subject_code')
                            <span class="text-danger p" style="font-size:10px;">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        <input value="{{ old('subject_code') }}" type="text" name="subject_code" id="subject_code" required
                            class="form-control">
                    </div>

                    <div class="container">
                        <label class="fw-bold">Subject Name</label>@error('name')
                            <span class="text-danger p" style="font-size:10px;">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        <input value="{{ old('text') }}" type="text" name="name" id="name" required
                            class="form-control">
                    </div>
                
                    <div class="container">
                        <label class="fw-bold">Grade Level</label>
                        @error('semester_id')
                            <span class="text-danger p" style="font-size:10px;">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        <select name="level" id="level" class="level form-control">
                            <option value="" class="form-control" disabled selected >Select a Level</option>
                                <option value="11" {{ old('level') == 11? 'selected' : '' }} class="form-control">Grade 11</option>
                                <option value="12" {{ old('level') == 12? 'selected' : '' }} class="form-control">Grade 12</option>
                        </select>
                    </div>

                    <div class="container">
                        <label class="fw-bold">No. of Hours</label>
                            @error('hrs')
                            <span class="text-danger p" style="font-size:10px;">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        <input value="{{ old('hrs') }}" type="text" name="hrs" id="hrs" required
                            class="form-control">
                    </div>

                    <div class="container">
                        <button type="submit" class="btn text-white form-control" style="background: #189993">Update</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Subject Modal -->
    <div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="addSubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSubjectModalLabel">ADd Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('subject.store') }}" class="d-flex flex-column gap-3">
                        @csrf
                        <div class="container">
                            <label class="fw-bold">Subject Code</label>
                                @error('subject_code')
                                <span class="text-danger p" style="font-size:10px;">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                            <input value="{{ old('subject_code') }}" type="text" name="subject_code" id="subject_code" required
                                class="form-control" placeholder="e.g. MAT-101">
                        </div>

                        <div class="container">
                            <label class="fw-bold">Subject Name</label>
                                @error('name')
                                <span class="text-danger p" style="font-size:10px;">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                            <input value="{{ old('text') }}" type="text" name="name" id="text" required
                                class="form-control" placeholder="e.g. General Mathematics">
                        </div>
                    
                        <div class="container">
                            <label class="fw-bold">Grade Level</label>
                            @error('semester_id')
                                <span class="text-danger p" style="font-size:10px;">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                            <select name="level" id="level" class="form-control">
                                <option value="" class="form-control" disabled selected >Select a Level</option>

                                    <option value="11" {{ old('level')==11?'selected':''}} class="form-control">Grade 11</option>
                                    <option value="12" {{ old('level')==12?'selected':''}} class="form-control">Grade 12</option>

                            </select>
                        </div>
                    
                        <div class="container">
                            <label class="fw-bold">No. of Hours</label>
                                @error('hrs')
                                <span class="text-danger p" style="font-size:10px;">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                            <input value="{{ old('hrs') }}" type="text" name="hrs" id="hrs" required
                                class="form-control" placeholder="e.g. 2">
                        </div>

                        <div class="container">
                            <button type="submit" class="btn text-white form-control" style="background: #189993">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .subject,
        .editsubject {
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
            $(".addsubject").click(() => {
                $(".subject").removeClass('d-none')
            })

            $(".close").click(() => {
                $(".subject").addClass('d-none')
                $(".editsubject").addClass('d-none')
            })

            $(".esubject").click(() => {
                $(".editsubject").addClass('d-none')
            })

            $('.edit').click(async function () {

                const id = $(this).attr('data-id');
                const response = await fetch(`/admin/subject/edit/${id}`, {
                    headers: { 'Accept': 'application/json' }
                });

                if (!response.ok) {
                    throw new Error(`Server error: ${response.status}`);
                }

                const datas = await response.json();
                const data = datas
                console.log('Subject data:', data);
                $('#subject_code').val(data.subject.subject_code);
                $('#name').val(data.subject.name);
                $('#hrs').val(data.subject.hrs);
                $('.department_id').val(data.subject.department_id).change();
                $('.level').val(data.subject.level).change();
                $('.faculty_id').val(data.subject.faculty_id).change();



                const form = $('#editSubjectForm');
                const action = `/admin/subject/edit/${data.subject.id}`;
                form.attr('action', action);
                $('.editsubject').removeClass('d-none');
            });

        });

        $(document).ready(function () {
            $('#subjectTable').DataTable({
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