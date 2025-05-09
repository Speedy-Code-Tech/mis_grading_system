@extends('layouts.main', ['title' => 'SUBJECT', 'active' => 'subject'])

@section('content')
    <div class="container pt-5 w-100">
        <div class="d-flex justify-content-between items-center mb-3">
            <div class="d-flex gap-3 items-center w-50">
                <h4 class="fw-semibold">SUBJECT ASSIGNMENT</h4>
                <p class="m-0">
                    Home - 
                    <a href="{{ route('subject.index') }}" class="text-dark">Subject</a>
                    /
                    <a href="{{ route('assign-subjects.index') }}" class="text-dark">Subject Assignment</a>
                </p>
            </div>
            <button class="btn text-white addassignment" style="background: #189993; ">
                <i class="bi bi-plus-lg"></i> Assign
            </button>
        </div>

        @if (session('msg'))
            <script>
                Swal.fire({
                    title: 'Successful',
                    text: "{{ session('msg') }}",
                    icon: 'success',
                    // confirmButtonText: 'OK'
                });
            </script>
        @endif

        <table id="myTable" class="table table-hover table-white rounded">
            <thead>
                <tr>
                    <th class="p-2 px-4">SUBJECT</th>
                    <!-- <th class="p-2">SCHOOL YEAR</th> -->
                    <th class="p-2">TRACK</th>
                    <th class="p-2">GRADE LEVEL</th>
                    <th class="p-2">SECTION</th>
                    <th class="p-2">TEACHER</th>
                    <th class="p-2">ACTION</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($subjecAssignment as $subject)
                    <tr>
                        <td class="p-2 px-4">{{ $subject->subject->name }}</td>
                        <!-- <td class="p-2">2025</td> -->
                        <!-- <td class="p-2">STEM</td> -->
                        <td class="p-2">{{ $subject->department->course_code }}</td>
                        <td class="p-2">Grade {{ $subject->subject->level }}</td>
                        <td class="p-2">{{ $subject->section->name }}</td>
                        <td class="p-2">{{ $subject->faculty->fname }} {{ $subject->faculty->lname }}</td>

                        <td class="p-2">
                            <div class="d-flex justify-center gap-1" role="group">
                                <button style="background: #189993;" class="btn text-white edit" id="{{ $subject->id }}">
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

        <!-- includes -->
        
        @include('admin.assign-subjects.add')
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
            $(".addassignment").click(() => {
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

                const id = $(this).attr('id');
                const response = await fetch(`/admin/subject/edit/${id}`, {
                    headers: { 'Accept': 'application/json' }
                });

                if (!response.ok) {
                    throw new Error(`Server error: ${response.status}`);
                }

                const datas = await response.json();
                const data = datas
                console.log('Subject data:', data);
                $('#name').val(data.subject.name);
                $('.department_id').val(data.subject.department_id).change();
                $('.level').val(data.subject.level).change();
                $('.faculty_id').val(data.subject.faculty_id).change();



                const form = $('#editSubjectForm');
                const action = `/admin/subject/edit/${data.subject.id}`;
                form.attr('action', action);
                $('.editsubject').removeClass('d-none');
            });

        });
    </script>
@endsection