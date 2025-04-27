@extends('layouts.main', ['title' => 'DEPARTMENT', 'active' => 'department'])


@section('content')
    <div class="container pt-5 w-100">
        <div class="d-flex gap-5 align-items-center">
            <h4>DEPARTMENT LIST</h4>
            <p class="m-0">Home - Departments</p>
        </div>
        <div class="container-fluid d-flex justify-content-end">
            <button class="btn btn-success adddept"><i class="bi bi-plus-lg"></i> Add Department</button>
        </div>
        @if (session('msg'))
            <div class="alert alert-info mt-3">
                {{ session('msg') }}
            </div>
        @endif

        <table id="myTable" class="table table-hover table-white rounded">
            <thead>
                <tr>
                    <th>Department</th>
                    <th>Description</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($departments as $dept)
                    <tr>
                        <td>{{$dept->department}}</td>
                        <td>{{$dept->description}}</td>
                        <td>
                            <div class="conatiner-fluid d-flex gap-2">
                                <a style="text-decoration: none" class="btn edit" id={{ $dept->id }}> <i
                                        class="text-warning bi bi-pencil-square"></i> </a>
                                <a href="{{ route('department.destroy', $dept->id) }}" style="text-decoration: none" class="btn">
                                    <i class="text-danger bi bi-trash3-fill"></i> </a>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="department rounded d-none ">
            <div class="d-flex container-fluid">
                <h4 class="fw-bold p-4" style="width:90%;">Add Department</h4> <button class="btn close">X</button>
            </div>
            <div class="container-fluid d-flex flex-column gap-3">
                <form method="POST" action="{{ route('department.store') }}" class="d-flex flex-column gap-3">
                    @csrf

                    <div class="container">
                        <label>Department</label>
                        <input type="text" name="department" placeholder="Ex. STEM, TVL" id="department" required
                            class="form-control" value="{{ old('department') }}">
                        @error('department')
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
                        <button type="submit" class="btn btn-primary form-control">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="editdepartment rounded d-none ">
            <div class="d-flex container-fluid">
                <h4 class="fw-bold p-4" style="width:90%;">Edit Department</h4> <button class="btn eclose">X</button>
            </div>
            <div class="container-fluid d-flex flex-column gap-3">
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
                        <button type="submit" class="btn btn-primary form-control">Submit</button>
                    </div>
                </form>
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
                $('#edepartment').val(data.department);
                $('#edescription').val(data.description);
               

                const form = $('#editDepartmentForm');
                const action = `/admin/department/edit/${data.id}`;
                form.attr('action', action);
                $('.editdepartment').removeClass('d-none');
            });

        });
    </script>
@endsection