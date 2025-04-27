  {{-- ADD NEW FACULTY --}}
  <div class="faculty rounded d-none ">
    <div class="d-flex container-fluid">
        <h4 class="fw-bold p-4" style="width:90%;">Add Faculty</h4> <button class="btn close">X</button>
    </div>
    <div class="container-fluid d-flex flex-column gap-3">
        <form method="POST" action="{{ route('faculty.store') }}" class="d-flex flex-column gap-3">
            @csrf

            <div class="container d-flex align-items-center">
                <label>Status </label>
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                           {{ old('status') ? 'checked' : '' }}>
                </div>
            </div>

            <div class="row ps-3">
                <div class="row p-0 m-0 d-flex"><label for="" class="fw-bold h6 m-0">Full
                        Name</label> <span id="errorname" class="text-danger ps-2"></span></div>
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col">
                        <input id="fname" value="{{ old('fname') }}" name="fname" required placeholder="First Name" type="text"
                            class="form-control">
                    </div>
                    <div class="col">
                        <input name="mname" id="mname" value="{{ old('mname') }}" placeholder="Middle Name" type="text" class="form-control">
                    </div>
                    <div class="col pe-0">
                        <input name="lname" id="lname" required value="{{ old('lname') }}" placeholder="Last Name" type="text"
                            class="form-control">
                    </div>
                </div>
            </div>

            <div class="container">
                <label class="fw-bold">Email</label>@error('email')
                    <span class="text-danger p" style="font-size:10px;">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <input value="{{ old('email') }}" type="email" name="email" id="email" required
                    class="form-control">
            </div>
            <div class="container">
                <label class="fw-bold">Password</label>
                @error('password')
                    <span class="text-danger p" style="font-size:10px;">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <input value="{{ old('password') }}" type="password" name="password" id="password" required
                    class="form-control">
            </div>
            <div class="container">
                <label class="fw-bold">Semester</label>
                @error('semester_id')
                    <span class="text-danger p" style="font-size:10px;">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <select name="semester_id" id="semester_id" class="form-control">
                    <option value="" class="form-control" disabled selected >Seleact a Semester</option>
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
                <select name="department_id" id="department_id" class="form-control">
                    <option value="" class="form-control" disabled selected>Seleact a Department</option>
                    @foreach ($departments as $dept)
                        <option value="{{ $dept->id }}" class="form-control"  {{ old('department_id')==$dept->id?'selected':''}}>
                            {{$dept->department . ' - ' . $dept->description}}</option>
                    @endforeach
                </select>
            </div>
            <div class="container">
                <label class="fw-bold">Department Type</label>
                @error('department_type')
                    <span class="text-danger p" style="font-size:10px;">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <select name="department_type" id="department_type" class="form-control">
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