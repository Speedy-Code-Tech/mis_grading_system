  {{-- ADD NEW SUBJECT --}}
  <div class="editsubject rounded d-none ">
    <div class="d-flex container-fluid">
        <h4 class="fw-bold p-4" style="width:90%;">Edit Subect</h4> <button class="btn close">X</button>
    </div>
    <div class="container-fluid d-flex flex-column gap-3">
        
        <form method="POST" id="editSubjectForm" class="d-flex flex-column gap-3">
            @csrf
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
                <label class="fw-bold">Instructor</label>
                @error('instructor')
                    <span class="text-danger p" style="font-size:10px;">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <select name="faculty_id" id="faculty_id" class="faculty_id form-control">
                    <option value="" class="form-control" disabled selected >Select a Instructor</option>
                    @foreach ($faculties as $faculty)
                        <option value="{{ $faculty->id }}" {{ old('faculty_id')==$faculty->id?'selected':''}} class="form-control">{{$faculty->fname.' '.$faculty->mname.' '.$faculty->lname}}</option>
                    @endforeach
                </select>
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

                        <option value="11" {{ old('level')==11?'selected':''}} class="form-control">Grade 11</option>
                        <option value="12" {{ old('level')==12?'selected':''}} class="form-control">Grade 12</option>

                </select>
            </div>
            <div class="container">
                <label class="fw-bold">Department</label>
                @error('department_id')
                    <span class="text-danger p" style="font-size:10px;">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <select name="department_id" id="department_id" class="department_id form-control">
                    <option value="" class="form-control" disabled selected>Select a Department</option>
                    @foreach ($departments as $dept)
                        <option value="{{ $dept->id }}" class="form-control"  {{ old('department_id')==$dept->id?'selected':''}}>
                            {{$dept->department . ' - ' . $dept->description}}</option>
                    @endforeach
                </select>
            </div>
          

            <div class="container">
                <button type="submit" class="btn btn-primary form-control">Submit</button>
            </div>
        </form>
    </div>
</div>