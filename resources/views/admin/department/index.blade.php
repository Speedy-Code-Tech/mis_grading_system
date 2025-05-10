@extends('layouts.main', ['title' => 'TRACK', 'active' => 'track'])


@section('content')
    <div class="container pt-5 w-100">
        <div class="d-flex justify-content-between items-center mb-3">
            <div class="d-flex gap-3 items-center w-50">
                <h4 class="fw-semibold">ACADEMIC TRACK</h4>
                <p class="m-0">Home - track</p>
            </div>
            <button class="btn text-white adddept" style="background: #189993" data-bs-toggle="modal" data-bs-target="#addTrackModal">
                <i class="bi bi-plus-lg"></i> Track
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
            <table id="trackTable" class="table table-hover table-white rounded">
                <thead>
                    <tr>
                        <th class="bg-transparent p-2 px-4">Track</th>
                        <!-- <th class="bg-transparent p-2">School Year</th>
                        <th class="bg-transparent p-2">Semester</th> -->
                        <th class="bg-transparent p-2">Description</th>
                        <th class="bg-transparent p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $dept)
                        <tr>
                            <td class="bg-transparent p-2 px-4">{{$dept->course_code}}</td>
                            <td class="bg-transparent p-2">{{$dept->description}}</td>
                            <td class="bg-transparent p-2">
                                <div class="" role="group">
                                    <button style="background: #189993;" class="btn text-white edit" id="{{ $dept->id }}" data-bs-toggle="modal" data-bs-target="#editTrackModal">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <a href="{{ route('department.destroy', $dept->id) }}" class="btn btn-danger">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Add Faculty Modal -->
        <div class="modal fade" id="addTrackModal" tabindex="-1" aria-labelledby="addTrackModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTrackModalLabel">Add Track</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('department.store') }}" class="d-flex flex-column gap-3">
                            @csrf

                            <div class="container">
                                <label>Department</label>
                                <input type="text" name="course_code" placeholder="Ex. STEM, TVL" id="course_code" required
                                    class="form-control" value="{{ old('course_code') }}">
                                @error('course_code')
                                    <span class="text-danger p" style="font-size:10px;">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="container">
                                <label>Description</label>
                                <input type="text" placeholder="Ex. Science Technology Engineering and Mathematics"
                                    name="description" id="description" required class="form-control"
                                    value="{{ old('description') }}">
                                @error('description')
                                    <span class="text-danger p" style="font-size:10px;">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="container">
                                <button type="submit" class="btn text-white form-control" style="background: #189993">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Faculty Modal -->
        <div class="modal fade" id="editTrackModal" tabindex="-1" aria-labelledby="editTrackModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTrackModalLabel">Edit Track</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="editDepartmentForm" action="{{ route('department.store') }}" class="d-flex flex-column gap-3">
                            @csrf

                            <div class="container">
                                <label>Department</label>
                                <input type="text" name="edepartment" placeholder="Ex. STEM, TVL" id="edepartment" required
                                    class="form-control" value="{{ old('edepartment') }}">
                                @error('edepartment')
                                    <span class="text-danger p" style="font-size:10px;">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="container">
                                <label>Description</label>
                                <input type="text" placeholder="Ex. Science Technology Engineering and Mathematics"
                                    name="edescription" id="edescription" required class="form-control"
                                    value="{{ old('edescription') }}">
                                @error('edescription')
                                    <span class="text-danger p" style="font-size:10px;">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
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
        .department,
        .editdepartment {
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
            $(".adddept").click(() => {
                $(".department").removeClass('d-none')
            })

            $(".close").click(() => {
                $(".department").addClass('d-none')
            })

            $(".eclose").click(() => {
                $(".editdepartment").addClass('d-none')
            })

            $('.edit').click(async function () {

                const id = $(this).attr('id');
                const response = await fetch(`/admin/department/edit/${id}`, {
                    headers: { 'Accept': 'application/json' }
                });

                if (!response.ok) {
                    throw new Error(`Server error: ${response.status}`);
                }

                const datas = await response.json();  // parse JSON
                const data = datas.data
                console.log('Semester data:', data);
                $('#edepartment').val(data.course_code);
                $('#edescription').val(data.description);
               

                const form = $('#editDepartmentForm');
                const action = `/admin/department/edit/${data.id}`;
                form.attr('action', action);
                $('.editdepartment').removeClass('d-none');
            });

        });

        $(document).ready(function () {
            $('#trackTable').DataTable({
                responsive: true,
                paging: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25],
                searching: true,
                ordering: true,
                columnDefs: [
                    { orderable: false, targets: 2 }
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