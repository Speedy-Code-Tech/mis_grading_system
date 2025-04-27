<div class="editfaculty rounded d-none ">
    <div class="d-flex container-fluid">
        <h4 class="fw-bold p-4" style="width:90%;">Edit Faculty</h4> <button class="btn close">X</button>
    </div>
    <div class="container-fluid d-flex flex-column gap-3">
        <form method="POST"  id="editFacultyForm" action="" class="d-flex flex-column gap-3">
            @csrf

            <div class="container d-flex align-items-center">
                <label>Status </label>
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input status" type="checkbox" name="status" value="1"
                           {{ old('status') ? 'checked' : '' }}>
                </div>
            </div>

            <div class="row ps-3">
                <div class="row p-0 m-0 d-flex"><label for="" class="fw-bold h6 m-0">Full
                        Name</label> <span class="text-danger ps-2"></span></div>
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col">
                        <input  value="{{ old('fname') }}" name="fname" required placeholder="First Name" type="text"
                            class="form-control fname">
                    </div>
                    <div class="col">
                        <input name="mname" value="{{ old('mname') }}" placeholder="Middle Name" type="text" class="mname form-control">
                    </div>
                    <div class="col pe-0">
                        <input name="lname"  required value="{{ old('lname') }}" placeholder="Last Name" type="text"
                            class="form-control lname">
                    </div>
                </div>
            </div>

            <div class="container">
                <label class="fw-bold">Email</label>@error('email')
                    <span class="text-danger p" style="font-size:10px;">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <input value="{{ old('email') }}" type="email" name="email"  required
                    class="form-control  email">
            </div>
            <div class="container">
                <label class="fw-bold">Password</label>
                @error('password')
                    <span class="text-danger p" style="font-size:10px;">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <input value="{{ old('password') }}" type="password" name="password" 
                    class="form-control password">
            </div>
            <div class="container">
                <label class="fw-bold">Semester</label>
                @error('semester_id')
                    <span class="text-danger p" style="font-size:10px;">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <select name="semester_id"  class="form-control semester_id">
                    <option value="" class="form-control" disabled selected >Select a Semester</option>
                    @foreach ($semesters as $sem)
                        <option value="{{ $sem->id }}" {{ old('semester')==$sem->id?'selected':''}} class="form-control">{{$sem->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="container">
                <label class="fw-bold">Department</label>
                @error('department_id')
                    <span class="text-danger p" style="font-size:10px;">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <select name="department_id"  class="form-control department_id">
                    <option value="" class="form-control" disabled selected>Select a Department</option>
                    @foreach ($departments as $dept)
                        <option value="{{ $dept->id }}" class="form-control"  {{ old('department_id')==$dept->id?'selected':''}}>
                            {{$dept->department . ' - ' . $dept->description}}</option>
                    @endforeach
                </select>
            </div>
            <div class="container">
                <label class="fw-bold">Department Type</label>
                @error('department_type')
                    <span class="text-danger p " style="font-size:10px;">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <select name="department_type"  class="form-control department_type">
                    <option value="" class="form-control" disabled selected>Select a Department Type
                    </option>
                    <option value="head_teacher" class="form-control" {{ old('department_type')=='head_teacher'?'selected':''}}>Head Teacher</option>
                    <option value="teacher" class="form-control" {{ old('department_type')=='teacher'?'selected':''}}>Teacher</option>

                </select>
            </div>

            <div class="container">
                <button type="submit" class="btn btn-primary form-control">Submit</button>
            </div>
        </form>
    </div>
</div>