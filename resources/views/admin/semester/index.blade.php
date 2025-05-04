@extends('layouts.main', ['title' => 'SEMESTER', 'active' => 'semester'])

<style>
    .logo {}
</style>

@section('content')
    <div class="container pt-5 w-100">
        <div class="d-flex gap-5 align-items-center">
            <h4>SEMESTER LIST</h4>
            <p class="m-0">Home - Semester</p>
        </div>
        <div class="container-fluid d-flex justify-content-end">
            
            <button class="btn btn-success addsem" ><i class="bi bi-plus-lg"></i> Add Semester</button>
        </div>
        @if (session('msg'))
        <div class="alert alert-info mt-3">
          {{ session('msg') }}
        </div>
      @endif
      
        <table id="myTable" class="table table-hover table-white rounded">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>School Year</th>
                    <th>Region</th>
                    <th>Division</th>
                    <th>School Name</th>
                    <th>School ID</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($semesters as $sem)
                    <tr>
                        <td>{{$sem->name}}</td>
                        <td>{{$sem->start_year.' - '.$sem->end_year}}</td>
                        <td>{{$sem->region}}</td>
                        <td>{{$sem->division}}</td>
                        <td>{{$sem->school_name}}</td>
                        <td>{{$sem->school_id}}</td>
                        <td><span class="fw-bold {{$sem->status=='active'?"text-success":"text-warning"}}">{{$sem->status=='active'?"Active":"Inactive"}}</span></td>
                        <td>
                           <div class="conatiner-fluid d-flex gap-2">
                            <a style="text-decoration: none" class="btn edit" id={{ $sem->id }}> <i class="text-warning bi bi-pencil-square"></i> </a>
                            <a href="{{ route('semester.destroy',$sem->id) }}" style="text-decoration: none" class="btn"> <i class="text-danger bi bi-trash3-fill"></i> </a>
                               
                        </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Add Semester -->
        <div class="semester rounded d-none ">
            <div class="d-flex container-fluid">
                <h4 class="fw-bold p-4" style="width:90%;">Add Semester</h4> <button class="btn close">X</button>
            </div>
            <div class="container-fluid d-flex flex-column gap-3">
                <form method="POST" action="{{ route('semester.store') }}" class="d-flex flex-column gap-3">
                    @csrf
                    <div class="container d-flex align-items-center">
                        <label>Status </label>
                        <div class="form-check form-switch mb-0">
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
                        <label>Region</label>  @error('region')
                        <span class="text-danger p" style="font-size:10px;">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                        <input value="{{ old('region') }}" type="text" name="region" id="region" required class="form-control">
                    </div>
                    <div class="container">
                        <label>Division</label>@error('division')
                        <span class="text-danger p" style="font-size:10px;">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                        <input value="{{ old('division') }}" type="text" name="division" id="division" required class="form-control">
                    </div>
                    <div class="container">
                        <label>School Name</label>@error('school_name')
                        <span class="text-danger p" style="font-size:10px;">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                        <input value="{{ old('school_name') }}" type="text" name="school_name" id="school_name" required class="form-control">
                    </div>
                    <div class="container">
                        <label>School ID</label>@error('school_id')
                        <span class="text-danger p" style="font-size:10px;">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                        <input value="{{ old('school_id') }}" type="text" name="school_id" id="school_id" required class="form-control">
                    </div>
                    <div class="d-flex container-fluid">
                        <p class="fw-bold" style="width:90%;">Grading</p>
                    </div>
                    <div class="container">
                        <label>Written Work</label>@error('written_work')
                        <span class="text-danger p" style="font-size:10px;">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                        <input value="{{ old('written_work') }}" type="text" name="written_work" id="written_work" required class="form-control">
                    </div>
                    <div class="container">
                        <label>Performace Task</label>@error('performance_task')
                        <span class="text-danger p" style="font-size:10px;">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                        <input value="{{ old('performance_task') }}" type="text" name="performance_task" id="performance_task" required class="form-control">
                    </div>
                    <div class="container">
                        <label>Quarterly Assesment</label>@error('quarterly_assesment')
                        <span class="text-danger p" style="font-size:10px;">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                        <input value="{{ old('quarterly_assesment') }}" type="text" name="quarterly_assesment" id="quarterly_assesment" required
                            class="form-control">
                    </div>
                    <div class="container">
                        <button type="submit" class="btn btn-primary form-control">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Semester -->
        <div class="editsemester rounded d-none">
            <div class="d-flex container-fluid">
                <h4 class="fw-bold p-4" style="width:90%;">Edit Semester</h4> <button class="btn closed">X</button>
            </div>
            <div class="container-fluid d-flex flex-column gap-3">
                <form method="POST" id="editSemesterForm" class="d-flex flex-column gap-3">
                    @csrf
                    <div class="container d-flex align-items-center">
                        <label>Status </label>
                        <div class="form-check form-switch mb-0">
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
                        <label>Region</label>  @error('region')
                        <span class="text-danger p" style="font-size:10px;">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                        <input value="{{ old('region') }}" type="text" name="eregion" id="eregion" required class="form-control">
                    </div>
                    <div class="container">
                        <label>Division</label>@error('division')
                        <span class="text-danger p" style="font-size:10px;">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                        <input value="{{ old('division') }}" type="text" name="edivision" id="edivision" required class="form-control">
                    </div>
                    <div class="container">
                        <label>School Name</label>@error('school_name')
                        <span class="text-danger p" style="font-size:10px;">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                        <input value="{{ old('school_name') }}" type="text" name="eschool_name" id="eschool_name" required class="form-control">
                    </div>
                    <div class="container">
                        <label>School ID</label>@error('school_id')
                        <span class="text-danger p" style="font-size:10px;">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                        <input value="{{ old('school_id') }}" type="text" name="eschool_id" id="eschool_id" required class="form-control">
                    </div>
                    <div class="d-flex container-fluid">
                        <p class="fw-bold" style="width:90%;">Grading</p>
                    </div>
                    <div class="container">
                        <label>Written Work</label>@error('written_work')
                        <span class="text-danger p" style="font-size:10px;">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                        <input value="{{ old('written_work') }}" type="text" name="ewritten_work" id="ewritten_work" required class="form-control">
                    </div>
                    <div class="container">
                        <label>Performace Task</label>@error('performance_task')
                        <span class="text-danger p" style="font-size:10px;">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                        <input value="{{ old('performance_task') }}" type="text" name="eperformance_task" id="eperformance_task" required class="form-control">
                    </div>
                    <div class="container">
                        <label>Quarterly Assesment</label>@error('quarterly_assesment')
                        <span class="text-danger p" style="font-size:10px;">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                        <input value="{{ old('quarterly_assesment') }}" type="text" name="equarterly_assesment" id="equarterly_assesment" required
                            class="form-control">
                    </div>
                    <div class="container">
                        <button type="submit" class="btn btn-primary form-control">Submit</button>
                    </div>
                </form>
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
            $('#myTable').DataTable();

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

    const datas = await response.json();  // parse JSON
    const data = datas.data
    console.log('Semester data:', data);
    $('#id').val(data.id);
    $('#ename').val(data.name);
    $('#estart_year').val(data.start_year);
    $('#eend_year').val(data.end_year);
    $('#eregion').val(data.region);
    $('#edivision').val(data.division);
    $('#eschool_name').val(data.school_name);
    $('#eschool_id').val(data.school_id);
    $('#ewritten_work').val(data.written_work);
    $('#eperformance_task').val(data.performance_task);
    $('#equarterly_assesment').val(data.quarterly_assesment);        
    
    if(data.status=='active'){
        $('#estatus')
  .prop('checked', true)                  // set the checkbox state
  .trigger('change');   
    }else{
        $('#estatus')
  .prop('checked', false)                  // set the checkbox state
  .trigger('change');   
    }

    const form = $('#editSemesterForm');
  const action = `/admin/semester/edit/${data.id}`;
  form.attr('action', action);
  $('.editsemester').removeClass('d-none');
});

        })

    </script>
@endsection