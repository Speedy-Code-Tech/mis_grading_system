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
            <table id="subjectTable" class="table table-hover table-white rounded">
                <thead>
                    <tr>
                        <th class="bg-transparent p-2 px-4">Code</th>
                        <th class="bg-transparent p-2">Subject Name</th>
                        <th class="bg-transparent p-2">Track</th>
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
                            <td class="bg-transparent p-2">{{ $subject->department->course_code }} - {{ $subject->department->description }}</td>
                            <td class="bg-transparent p-2">Grade {{ $subject->level }}</td>
                            <td class="bg-transparent p-2">{{ $subject->hrs }} hrs</td>
                            <td class="bg-transparent p-2">
                                <div class="d-flex justify-center gap-1" role="group">
                                    <button 
                                        class="btn btn-warning text-white assign-teacher" 
                                        data-id="{{ $subject->id }}"
                                        data-subject-name="{{ $subject->name }}"
                                        data-subject-level="{{ $subject->level }}"
                                        data-department-id="{{ $subject->department_id }}"
                                        data-department-text="{{ $subject->department->course_code . ' - ' . $subject->department->description }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#assignTeacherModal"
                                    >
                                        <i class="bi bi-person-plus-fill"></i>
                                    </button>
                                    <button 
                                        style="background: #189993" 
                                        class="btn text-white edit" 
                                        data-id="{{ $subject->id }}" 
                                        data-subject-code="{{ $subject->subject_code }}" 
                                        data-name="{{ $subject->name }}" 
                                        data-level="{{ $subject->level }}" 
                                        data-hrs="{{ $subject->hrs }}" 
                                        data-department-id="{{ $subject->department_id }}"  
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editSubjectModal"
                                    >
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


        <div class="bg-white p-4 shadow rounded mt-5">
            <h4 class="fw-semibold mb-3">ASSIGNED SUBJECT TEACHERS</h4>
            <table id="assignedSubjectTeachersTable" class="table table-hover table-white rounded">
                <thead>
                    <tr>
                        <th class="bg-transparent p-2 px-4">Subject</th>
                        <th class="bg-transparent p-2">Instructor</th>
                        <th class="bg-transparent p-2">Track</th>
                        <th class="bg-transparent p-2">Semester</th>
                        <th class="bg-transparent p-2">Quarter</th>
                        <th class="bg-transparent p-2">Grade Level</th>
                        <th class="bg-transparent p-2">Section</th>
                        <!-- <th class="bg-transparent p-2">Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjecAssignment as $subject)
                        <tr>
                            <td class="bg-transparent p-3 px-4">{{ $subject->subject->name }}</td>
                            <td class="bg-transparent p-3">{{ $subject->faculty->fname }} {{ $subject->faculty->lname }}</td>
                            <td class="bg-transparent p-3">{{ $subject->department->course_code }}</td>
                            <td class="bg-transparent p-3">{{ $subject->semester->name }}</td>
                            <td class="bg-transparent p-3">{{ $subject->quarter->name }}</td>
                            <td class="bg-transparent p-3">Grade {{ $subject->subject->level }}</td>
                            <td class="bg-transparent p-3">{{ $subject->section->name }}</td>
                            <!-- <td class="bg-transparent p-2">
                                <div class="d-flex justify-center gap-1" role="group">
                                    <button style="background: #189993;" class="btn text-white edit" id="{{ $subject->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <a href="{{ route('subject.destroy', $subject->id) }}" class="btn btn-danger">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>
                                </div>
                            </td> -->
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignTeacherModalLabel">Assign Instructor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('assign-subjects.store') }}" class="d-flex flex-wrap gap-4">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-7">
                                <label class="fw-bold">Subject Name</label>
                                @error('subject_id')
                                    <span class="text-danger" style="font-size:10px;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="subject_name" 
                                    value="{{ $selectedSubject->name ?? 'No Subject Selected' }}" 
                                    readonly
                                >

                                <input 
                                    type="hidden" 
                                    name="subject_id" 
                                    id="subject_id" 
                                    value="{{ $selectedSubject->id ?? '' }}"
                                >
                            </div>

                            <div class="col-md-5">
                                <label class="fw-bold">Instructor</label>
                                @error('instructor')
                                    <span class="text-danger" style="font-size:10px;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <select name="faculty_id" id="faculty_id" class="form-control">
                                    <option value="" disabled selected>Select an Instructor</option>
                                    @foreach ($faculties as $faculty)
                                        <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>
                                            {{ $faculty->fname . ' ' . $faculty->mname . ' ' . $faculty->lname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="fw-bold">Semester</label>
                                <select name="semester_id" id="semester_id" class="form-control">
                                    <option value="" disabled selected>Select a Semester</option>
                                    @foreach ($semesters as $semester)
                                        <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="fw-bold">Quarter</label>
                                <select name="quarter_id" id="quarter_id" class="form-control">
                                    <option value="" disabled selected>Select a Quarter</option>
                                    <!-- Quarters will be populated here dynamically -->
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="fw-bold">Grade Level</label>
                                @error('level')
                                    <span class="text-danger" style="font-size:10px;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="level_display" 
                                    value="{{ $selectedSubject->level ?? 'Not Set' }}" 
                                    readonly
                                >

                                <input 
                                    type="hidden" 
                                    name="level" 
                                    id="level" 
                                    value="{{ $selectedSubject->level ?? '' }}"
                                >
                            </div>

                            <div class="col-md-6">
                                <label class="fw-bold">Track</label>
                                @error('department_id')
                                    <span class="text-danger" style="font-size:10px;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="department_display" 
                                    value="{{ isset($selectedSubject) && $selectedSubject->department ? $selectedSubject->department->course_code . ' - ' . $selectedSubject->department->description : 'No Track Selected' }}" 
                                    readonly
                                >

                                <input 
                                    type="hidden" 
                                    name="department_id" 
                                    id="department_id" 
                                    value="{{ $selectedSubject->department_id ?? '' }}"
                                >
                            </div>

                            <div class="col-md-6">
                                <label class="fw-bold">Section</label>
                                <select name="section_id" id="section_id" class="form-control">
                                    <option value="" disabled selected>Select a Section</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                            {{ $section->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn text-white form-control mt-3" style="background: #189993">
                                    Assign
                                </button>
                            </div>
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
                        <label class="fw-bold">Track</label>
                        @error('department_id')
                            <span class="text-danger p" style="font-size:10px;">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        <select name="department_id" id="department_id" class="department_id form-control">
                            <option value="" class="form-control" disabled selected>Select a Department</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}" class="form-control"  {{ old('department_id')==$dept->id?'selected':''}}>
                                    {{$dept->course_code . ' - ' . $dept->description}}</option>
                            @endforeach
                        </select>
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
                            <label class="fw-bold">Track</label>
                            @error('department_id')
                                <span class="text-danger p" style="font-size:10px;">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                            <select name="department_id" id="department_id" class="department_id form-control">
                                <option value="" class="form-control" disabled selected>Select a Department</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept->id }}" class="form-control"  {{ old('department_id')==$dept->id?'selected':''}}>
                                        {{$dept->course_code . ' - ' . $dept->description}}</option>
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
        // Quarter filters
        document.getElementById('semester_id').addEventListener('change', function () {
            const semester = this.value;
            const quarterSelect = document.getElementById('quarter_id');

            // Clear out any existing options
            quarterSelect.innerHTML = '<option value="" disabled selected>Select a Quarter</option>';

            // List of quarters (you can replace this with an AJAX call if you want dynamic data)
            const quarters = [
                { id: 1, name: '1st Quarter', semester_id: 1 },
                { id: 2, name: '2nd Quarter', semester_id: 1 },
                { id: 3, name: '3rd Quarter', semester_id: 2 },
                { id: 4, name: '4th Quarter', semester_id: 2 },
            ];

            // Filter quarters based on the selected semester
            const filteredQuarters = quarters.filter(q => q.semester_id == semester);

            // Append filtered quarters to the dropdown
            filteredQuarters.forEach(q => {
                const option = document.createElement('option');
                option.value = q.id;
                option.textContent = q.name;
                quarterSelect.appendChild(option);
            });
        });

        // Assign Instructor Listeners
        document.querySelectorAll('.assign-teacher').forEach(button => {
            button.addEventListener('click', function () {
                const subjectId = this.dataset.id;
                const subjectName = this.dataset.subjectName;
                const subjectLevel = this.dataset.subjectLevel;
                const departmentId = this.dataset.departmentId;
                const departmentText = this.dataset.departmentText;

                // Set Subject
                document.getElementById('subject_name').value = subjectName;
                document.getElementById('subject_id').value = subjectId;

                // Set Grade Level
                document.getElementById('level_display').value = subjectLevel;
                document.getElementById('level').value = subjectLevel;

                // Set Track/Department
                document.getElementById('department_display').value = departmentText;
                document.getElementById('department_id').value = departmentId;
            });
        });

        // Edit Subject Listeners
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

            $('.edit').click(function () {
                // Get the values from data attributes
                const id = $(this).data('id');
                const subjectCode = $(this).data('subject-code');
                const name = $(this).data('name');
                const level = $(this).data('level');
                const hrs = $(this).data('hrs');
                const departmentId = $(this).data('department-id');

                // Set the values in the form
                $('#subject_code').val(subjectCode);
                $('#name').val(name);
                $('#hrs').val(hrs);

                // Use .val() and .change() to trigger the UI update
                $('.level').val(level).change();
                $('.department_id').val(departmentId).change();

                // Update the form action
                $('#editSubjectForm').attr('action', `/admin/subject/edit/${id}`);
            });

        });

        // DataTable Logics
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

            $('#assignedSubjectTeachersTable').DataTable({
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