@extends('layouts.main', ['title' => 'FACULTY', 'active' => 'faculty'])

<style>
    .status-active {
        color: #189993;
    }

    .status-inactive {
        color: red;
    }

</style>

@section('content')
    <div class="container pt-5 w-100">
        <div class="d-flex justify-content-between items-center mb-3">
            <div class="d-flex gap-3 items-center w-50">
                <h4 class="fw-semibold">FACULTY LIST</h4>
                <p class="m-0">Home - Faculty</p>
            </div>
            <button class="btn text-white addfaculty" style="background: #189993"><i class="bi bi-plus-lg"></i> Add Faculty</button>
        </div>
        @if (session('msg'))
            <div class="alert alert-info mt-3">
                {{ session('msg') }}
            </div>
        @endif

        <div class="container mt-4">
            <table id="myTable" class="table table-hover table-striped rounded shadow-sm">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="p-2 px-4">NAME</th>
                        <th class="p-2">EMAIL</th>
                        <th class="p-2">TRACK</th>
                        <!-- <th class="p-2">SUBJECT</th> -->
                        <th class="p-2">STATUS</th>
                        <th class="p-2 text-center">ACTIONS</th>
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
                                    <button style="background: #189993;" class="btn text-white edit" id="{{ $faculty->id }}">
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
        @include('admin.faculty.add')
        {{-- EDIT A FACULTY --}}
        @include('admin.faculty.edit')




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
    </script>
@endsection