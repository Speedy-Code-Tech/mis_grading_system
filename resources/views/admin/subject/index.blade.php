@extends('layouts.main', ['title' => 'SUBJECT', 'active' => 'subject'])


@section('content')
    <div class="container pt-5 w-100">
        <div class="d-flex gap-5 align-items-center">
            <h4>SUBJECT LIST</h4>
            <p class="m-0">Home - Subject</p>
        </div>
        <div class="container-fluid d-flex justify-content-end">
            <button class="btn btn-success addsubject"><i class="bi bi-plus-lg"></i> Add Subject</button>
        </div>
        @if (session('msg'))
            <div class="alert alert-info mt-3">
                {{ session('msg') }}
            </div>
        @endif

        <table id="myTable" class="table table-hover table-white rounded">
            <thead>
                <tr>
                    <th>Subject Name</th>
                    <th>Instructor</th>
                    <th>Grade Level</th>
                    <th>Department</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($subjects as $subject)
                    <tr>
                        <td>{{$subject->name}}</td>
                        <td>
                            {{ $subject->faculty->fname . ' ' . 
                               ($subject->faculty->mname != null ? $subject->faculty->mname[0] : '') . 
                               ' ' . $subject->faculty->lname }}
                        </td>
                        <td>Grade {{$subject->level}}</td>
                        <td>{{$subject->department->department}}</td>

                        <td>
                            <div class="conatiner-fluid d-flex gap-2">
                                <a style="text-decoration: none" class="btn edit" id={{ $subject->id }}> <i
                                        class="text-warning bi bi-pencil-square"></i> </a>
                                <a href="{{ route('subject.destroy', $subject->id) }}" style="text-decoration: none"
                                    class="btn">
                                    <i class="text-danger bi bi-trash3-fill"></i> </a>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- ADD NEW FACULTY --}}
        @include('admin.subject.add')
        
            {{-- EDIT A FACULTY --}}
            @include('admin.subject.edit')




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