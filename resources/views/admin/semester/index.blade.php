@extends('layouts.main', ['title' => 'SEMESTER', 'active' => 'semester'])

@section('content')
    <div class="container pt-5 w-100">
        <div class="d-flex justify-content-between items-center mb-3">
            <div class="d-flex gap-3 items-center w-50">
                <h4 class="fw-semibold">SEMESTER LIST</h4>
                <p class="m-0">Home - Semester</p>
            </div>
            <button class="btn text-white addsem" style="background: #189993" data-bs-toggle="modal" data-bs-target="#addSemesterModal">
                <i class="bi bi-plus-lg"></i> Add Semester
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
            <table id="semesterTable" class="table table-hover table-white rounded">
                <thead>
                    <tr>
                        <th class="bg-transparent p-2 px-4">Name</th>
                        <th class="bg-transparent p-2">School Year</th>
                        <th class="bg-transparent p-2">Status</th>
                        <th class="bg-transparent p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($semesters as $sem)
                        <tr>
                            <td class="bg-transparent p-2 px-4">{{$sem->name}}</td>
                            <td class="bg-transparent p-2">{{$sem->start_year.' - '.$sem->end_year}}</td>
                            <td class="bg-transparent p-2">
                                <span class="badge p-2 {{ $sem->status == true ? 'bg-success' : 'bg-warning' }}">
                                    {{ $sem->status == true ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="bg-transparent p-2">
                                <div class="" role="group">
                                    <button style="background: #189993" class="btn text-white edit" id="{{ $sem->id }}" data-bs-toggle="modal" data-bs-target="#editSemesterModal"> 
                                        <i class="bi bi-pencil-square"></i> 
                                    </button>
                                    <a href="{{ route('semester.destroy', $sem->id) }}" style="text-decoration: none" class="btn btn-danger"> 
                                        <i class="bi bi-trash3-fill"></i> 
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Add Semester Modal -->
        <div class="modal fade" id="addSemesterModal" tabindex="-1" aria-labelledby="addSemesterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSemesterModalLabel">Add Semester</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('semester.store') }}" class="d-flex flex-column gap-3">
                            @csrf
                            <div class="container d-flex align-items-center">
                                <label>Status </label>
                                <div class="form-check form-switch mb-0 ms-2">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                                        {{ old('status') ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="container">
                                <label>Name</label>
                                <input type="text" name="name" id="name" required class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger p" style="font-size:10px;">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="container d-flex">
                                <div class="container p-0 m-0">
                                    <label>School Year</label>
                                    @error('start_year')
                                        <span class="text-danger p" style="font-size:10px;">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror

                                    <input class="form-control" type="number" id="start_year" name="start_year" pattern="\d{4}"
                                    value="{{ old('start_year') }}"
                                        maxlength="4" placeholder="YYYY" required>
                                </div>
                                <div class="container pe-0">
                                    <label style="opacity:0;">asasas</label> @error('end_year')
                                        <span class="text-danger p" style="font-size:10px;">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                    <input value="{{ old('end_year') }}" class="form-control" type="number" id="end_year" name="end_year" pattern="\d{4}"
                                        maxlength="4" placeholder="YYYY" required>
                                </div>
                            </div>
                            <div class="container">
                                <button type="submit" class="btn text-white form-control" style="background: #189993">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Semester Modal -->
        <div class="modal fade" id="editSemesterModal" tabindex="-1" aria-labelledby="editSemesterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSemesterModalLabel">Edit Semester</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="editSemesterForm" class="d-flex flex-column gap-3">
                            @csrf
                            <div class="container d-flex align-items-center">
                                <label>Status </label>
                                <div class="form-check form-switch mb-0 ms-2">
                                    <input class="form-check-input" type="checkbox" id="estatus" name="estatus" value="1"
                                        {{ old('status') ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="container">
                                <label>Name</label>
                                <input type="text" name="ename" id="ename" required class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger p" style="font-size:10px;">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="container d-flex">
                                <div class="container p-0 m-0">
                                    <label>School Year</label>
                                    @error('start_year')
                                        <span class="text-danger p" style="font-size:10px;">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror

                                    <input class="form-control" type="number" id="estart_year" name="estart_year" pattern="\d{4}"
                                    value="{{ old('start_year') }}"
                                        maxlength="4" placeholder="YYYY" required>
                                </div>
                                <div class="container pe-0">
                                    <label style="opacity:0;">asasas</label> @error('end_year')
                                        <span class="text-danger p" style="font-size:10px;">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                    <input value="{{ old('end_year') }}" class="form-control" type="number" id="eend_year" name="eend_year" pattern="\d{4}"
                                        maxlength="4" placeholder="YYYY" required>
                                </div>
                            </div>
                            <div class="container">
                                <button type="submit" class="btn text-white form-control" style="background: #189993">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <style>
        .semester,.editsemester {
            background: white;
            width: 40%;
            height: 80%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            overflow-y: scroll;

        }
    </style>

    <script>

        $(document).ready(function () {

            $('.addsem').click(() => {
                $('.semester').removeClass('d-none');

            })
            $('.close').click(() => {
                $('.semester').addClass('d-none');

            })
            $('.closed').click(() => {
                $('.editsemester').addClass('d-none');
            })
          

            $('.edit').click(async function() {
           
                const id = $(this).attr('id');
                const response = await fetch(`/admin/semester/edit/${id}`, {
                    headers: { 'Accept': 'application/json' }
                });

                if (!response.ok) {
                    throw new Error(`Server error: ${response.status}`);
                }

                const datas = await response.json();
                const data = datas.data
                console.log('Semester data:', data);
                $('#id').val(data.id);
                $('#ename').val(data.name);
                $('#estart_year').val(data.start_year);
                $('#eend_year').val(data.end_year);
                
                if(data.status == 1) {
                    $('#estatus')
                        .prop('checked', true)
                        .trigger('change');   
                } else {
                    $('#estatus')
                        .prop('checked', false)
                        .trigger('change');   
                }

                const form = $('#editSemesterForm');
                const action = `/admin/semester/edit/${data.id}`;
                form.attr('action', action);
                $('.editsemester').removeClass('d-none');
            });

        })

        $(document).ready(function () {
            $('#semesterTable').DataTable({
                responsive: true,
                paging: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25],
                searching: true,
                ordering: true,
                columnDefs: [
                    { orderable: false, targets: 3 }
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