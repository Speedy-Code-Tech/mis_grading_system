{{-- ASSIGN SUBJECT TEACHER --}}
  <div class="subject rounded d-none ">
    <div class="d-flex container-fluid">
        <h4 class="fw-bold p-4" style="width:90%;">Assign Subject Teacher</h4> <button class="btn close">X</button>
    </div>
    <div class="container-fluid d-flex flex-column gap-3">
        <form method="POST" action="{{ route('assign-subjects.store') }}" class="d-flex flex-column gap-3">
            @csrf
            <div class="container">
                <label class="fw-bold">Subject Name</label>
                @error('name')
                    <span class="text-danger p" style="font-size:10px;">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <select name="subject_id" id="subject_id" class="form-control">
                    <option value="" class="form-control" disabled selected >Select a Subject</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }} class="form-control">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="container">
                <label class="fw-bold">Instructor</label>
                @error('instructor')
                    <span class="text-danger p" style="font-size:10px;">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <select name="faculty_id" id="faculty_id" class="form-control">
                    <option value="" class="form-control" disabled selected >Select an Instructor</option>
                    @foreach ($faculties as $faculty)
                        <option value="{{ $faculty->id }}" {{ old('faculty_id')==$faculty->id?'selected':''}} class="form-control">{{$faculty->fname.' '.$faculty->mname.' '.$faculty->lname}}</option>
                    @endforeach
                </select>
            </div>

            <div class="container">
                <label class="fw-bold">Semester</label>
                @error('semester')
                    <span class="text-danger p" style="font-size:10px;">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <select name="semester_id" id="semester_id" class="form-control">
                    <option value="" class="form-control" disabled selected >Select a Semester</option>
                    @foreach ($semesters as $semester)
                        <option value="{{ $semester->id }}" {{ old('semester_id') == $semester->id? 'selected' : '' }} class="form-control">{{ $semester->name }}</option>
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
                <select name="level" id="level" class="form-control">
                    <option value="" class="form-control" disabled selected >Select a Level</option>

                        <option value="11" {{ old('level')==11?'selected':''}} class="form-control">Grade 11</option>
                        <option value="12" {{ old('level')==12?'selected':''}} class="form-control">Grade 12</option>

                </select>
            </div>

            <div class="container">
                <label class="fw-bold">Track</label>
                @error('department_id')
                    <span class="text-danger p" style="font-size:10px;">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <select name="department_id" id="department_id" class="form-control">
                    <option value="" class="form-control" disabled selected>Select a Track</option>
                    @foreach ($departments as $dept)
                        <option value="{{ $dept->id }}" class="form-control"  {{ old('department_id')==$dept->id?'selected':''}}>
                            {{$dept->course_code . ' - ' . $dept->full_name}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="container">
                <label class="fw-bold">Section</label>
                @error('section')
                    <span class="text-danger p" style="font-size:10px;">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <select name="section_id" id="section_id" class="form-control">
                    <option value="" class="form-control" disabled selected >Select a Section</option>
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}" {{ old('section_id') == $semester->id? 'selected' : '' }} class="form-control">{{ $section->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="container">
                <button type="submit" class="btn btn-primary form-control">Submit</button>
            </div>
        </form>
    </div>
</div>