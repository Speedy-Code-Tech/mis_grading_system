@extends('layouts.main', ['title' => 'STUDENT', 'active' => 'student'])
@php
    $class = "border border-danger text-danger";
@endphp

@section('content')
    <div class="container pt-5 w-100 bg-white h-100" style="overflow-y:scroll;">
        <div class="d-flex pb-3 gap-5 align-items-center">
            <h4>EDIT STUDENT</h4>
            <p class="m-0">Home - Student List - Edit Student </p>
        </div>
        {{-- <div class="container-fluid d-flex justify-content-end">
            <a href="{{ route('student.index') }}" class="btn btn-success addfaculty"><i class="bi bi-arrow-left"></i>
                Back</a>
        </div>
        --}}
        <h5 class="fw-bold" style="color:#189993;">Overview</h5>
        <div class="container-fluid d-flex mt-4">
            <div class="col-3 fw-bold">Profile Details</div>
            <div class="col-9 d-flex justify-content-end gap-3 align-items-center">
                <div class="d-flex justify-content-center gap-3 align-items-center">
                    <a href="{{ route('student.view',$student->student_id) }}" class="fw-bold btn" style="color:#189993; text-decoration: none;"><i
                            class="bi bi-info-circle-fill"></i> View</a>
                    <a href="{{ route('student.index') }}" class="btn btn-primary"><i class="bi bi-arrow-bar-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="container-fluid pt-5 p-0 m-0 d-flex flex-column">
            <form action="{{ route('student.update',$student->id) }}" method="POST" class="container-fluid pt-5 m-0 d-flex flex-column gap-3">
             @csrf
                {{-- FULLNAME --}}
                <div class="row d-flex">
                    <div class="col-3">
                        <p>Full Name <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-9 d-flex justify-content-even gap-3">
                        <div class="col">
                            <input type="text" placeholder="First Name" required name="fname" value="{{ old('fname')?old('fname'):$student->fname }}"
                                class="form-control @error('fname'){{ $class }}@enderror">
                            @error('fname')
                                <span class="text-danger fw-bold" style="font-size:10px;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Middle Name (Optional)" name="mname" value="{{ old('mname')?old('mname'):$student->mname }}"
                                class="form-control @error('mname'){{ $class }}@enderror"">
                                            @error('mname')
                                                                <span class=" text-danger fw-bold"
                                                style="font-size:10px;">{{$message}}</span>
                                            @enderror
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Last Name" required name="lname" value="{{ old('lname')?old('lname'):$student->lname }}"
                                class="form-control @error('lname'){{ $class }}@enderror"">
                                            @error('lname')
                                                                <span class=" text-danger fw-bold"
                                                style="font-size:10px;">{{$message}}</span>
                                            @enderror
                        </div>
                    </div>
                </div>
                {{-- GENDER --}}
                <div class="row d-flex">
                    <div class="col-3">
                        <p>Gender <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-9 d-flex justify-content-even gap-3">
                        <div class="col">
                            <select name="gender" class="form-control @error('gender'){{ $class }}@enderror" required>
                                <option value="" class="form-control" selected disabled>Select</option>
                                <option value="Male" class="form-control" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female" class="form-control" {{ $student->gender == 'Female' ? 'selected' : '' }}>
                                    Female</option>
                            </select>
                            @error('gender')
                                <span class="text-danger fw-bold" style="font-size:10px;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- BIRTHDATE --}}
                <div class="row d-flex">
                    <div class="col-3">
                        <p>Birthdate <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-9 d-flex justify-content-even gap-3">
                        <div class="col">
                            <input type="date" name="bdate" placeholder="Select Birthdate" value="{{ old('bdate')?old('bdate'):$student->bdate }}"
                                class="form-control @error('bdate'){{ $class }}@enderror">
                            @error('bdate')
                                <span class="text-danger fw-bold" style="font-size:10px;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- Contact Number --}}
                <div class="row d-flex">
                    <div class="col-3">
                        <p>Phone Number <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-9 d-flex justify-content-even gap-3">
                        <div class="col">
                            <input type="text" name="contact" placeholder="0938*****13" value="{{ old('contact')?old('contact'):$student->contact }}"
                                class="form-control @error('contact'){{ $class }}@enderror">
                            @error('contact')
                                <span class="text-danger fw-bold" style="font-size:10px;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- Email --}}
                <div class="row d-flex">
                    <div class="col-3">
                        <p>Email <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-9 d-flex justify-content-even gap-3">
                        <div class="col">
                            <input type="email" name="email" placeholder="johndoe@gmail.com" value="{{ old('email')?old('email'):$student->user->email }}"
                                class="form-control @error('email'){{ $class }}@enderror">
                            @error('email')
                                <span class="text-danger fw-bold" style="font-size:10px;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                 {{-- Password --}}
                 <div class="row d-flex">
                    <div class="col-3">
                        <p>Password <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-9 d-flex justify-content-even gap-3">
                        <div class="col">
                            <input type="password" name="password" placeholder="********" value="{{ old('password')?old('password'):'' }}"
                                class="form-control @error('password'){{ $class }}@enderror">
                            @error('password')
                                <span class="text-danger fw-bold" style="font-size:10px;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- Street --}}
                <div class="row d-flex">
                    <div class="col-3">
                        <p>Street <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-9 d-flex justify-content-even gap-3">
                        <div class="col">
                            <input type="text" name="street" placeholder="Street" value="{{ old('street')?old('street'):$student->street }}"
                                class="form-control @error('street'){{ $class }}@enderror">
                            @error('street')
                                <span class="text-danger fw-bold" style="font-size:10px;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- Region --}}
                <div class="row d-flex">
                    <div class="col-3">
                        <p>Region <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-9 d-flex justify-content-even gap-3">
                        <div class="col">
                            <input type="text" name="region" placeholder="I,II,III..." value="{{ old('region')?old('region'):$student->region }}"
                                class="form-control @error('region'){{ $class }}@enderror">
                            @error('region')
                                <span class="text-danger fw-bold" style="font-size:10px;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- Province --}}
                <div class="row d-flex">
                    <div class="col-3">
                        <p>Province <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-9 d-flex justify-content-even gap-3">
                        <div class="col">
                            <input type="text" name="province" placeholder="Ex. Camarines Norte"
                            value="{{ old('province')?old('province'):$student->province }}" class="form-control @error('province'){{ $class }}@enderror">
                            @error('province')
                                <span class="text-danger fw-bold" style="font-size:10px;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- City --}}
                <div class="row d-flex">
                    <div class="col-3">
                        <p>Municipality/City <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-9 d-flex justify-content-even gap-3">
                        <div class="col">
                            <input type="text" name="city" placeholder="Ex. Daet"value="{{ old('city')?old('city'):$student->city }}"
                                class="form-control @error('city'){{ $class }}@enderror">
                            @error('city')
                                <span class="text-danger fw-bold" style="font-size:10px;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- Barangay --}}
                <div class="row d-flex">
                    <div class="col-3">
                        <p>Barangay <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-9 d-flex justify-content-even gap-3">
                        <div class="col">
                            <input type="text" name="brgy" placeholder="Ex. Lag-On" value="{{ old('brgy')?old('brgy'):$student->brgy }}"
                                class="form-control @error('brgy'){{ $class }}@enderror">
                            @error('brgy')
                                <span class="text-danger fw-bold" style="font-size:10px;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- Type --}}
                <div class="row d-flex">
                    <div class="col-3">
                        <p>Type <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-9 d-flex justify-content-even gap-3">
                        <div class="col">
                            <div class="btn-group w-100" role="group" aria-label="Type options">

                                <input {{ $student->type == 'old' ? 'checked' : '' }} type="radio" class="btn-check" name="type" id="old" value="old" required
                                    autocomplete="off">
                                <label class="btn btn-outline-primary" for="old">Old</label>

                                <input {{ $student->type == 'new' ? 'checked' : '' }} type="radio" class="btn-check" name="type" id="new" value="new" required
                                    autocomplete="off">
                                <label class="btn btn-outline-primary" for="new">New</label>

                            </div>
                            @error('level')
                                <span class="text-danger fw-bold" style="font-size:10px;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- Level --}}
                <div class="row d-flex">
                    <div class="col-3">
                        <p>Grade Level <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-9 d-flex justify-content-even gap-3">
                        <div class="col">
                            <div class="btn-group w-100" role="group" aria-label="Grade level options">

                                <input {{ $student->level == 11 ? 'checked' : '' }} type="radio" class="btn-check" name="level" id="grade11" value="11" required
                                    autocomplete="off">
                                <label class="btn btn-outline-primary" for="grade11">Grade 11</label>

                                <input {{ $student->level == 12 ? 'checked' : '' }} type="radio" class="btn-check" name="level" id="grade12" value="12" required
                                    autocomplete="off">
                                <label class="btn btn-outline-primary" for="grade12">Grade 12</label>

                            </div>
                            @error('level')
                                <span class="text-danger fw-bold" style="font-size:10px;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- Strand --}}
                <div class="row d-flex">
                    <div class="col-3">
                        <p>Strand <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-9 d-flex justify-content-even gap-3">
                        <div class="col">
                            <div class="btn-group d-flex flex-column gap-2">
                                <div class="ps-0 form-check">
                                    <input class="btn-check" type="radio" name="strand" id="strand-abm" value="ABM" required autocomplete="off"
                                        {{ $student->strand == 'ABM' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary text-start d-flex align-items-start" for="strand-abm">
                                        <i class="bi bi-briefcase me-2"></i>
                                        <div>
                                            <strong>ABM</strong><br>
                                            <small>Accountancy and Business Management</small>
                                        </div>
                                    </label>
                                </div>
                            
                                <div class="ps-0 form-check">
                                    <input class="btn-check" type="radio" name="strand" id="strand-stem" value="STEM" required autocomplete="off"
                                        {{ $student->strand == 'STEM' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary text-start d-flex align-items-start" for="strand-stem">
                                        <i class="bi bi-bezier2 me-2"></i>
                                        <div>
                                            <strong>STEM</strong><br>
                                            <small>Science, Technology, Engineering and Mathematics</small>
                                        </div>
                                    </label>
                                </div>
                            
                                <div class="ps-0 form-check">
                                    <input class="btn-check" type="radio" name="strand" id="strand-humss" value="HUMSS" required autocomplete="off"
                                        {{ $student->strand == 'HUMSS' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary text-start d-flex align-items-start" for="strand-humss">
                                        <i class="bi bi-people-fill me-2"></i>
                                        <div>
                                            <strong>HUMSS</strong><br>
                                            <small>Humanities and Social Sciences</small>
                                        </div>
                                    </label>
                                </div>
                            
                                <div class="ps-0 form-check">
                                    <input class="btn-check" type="radio" name="strand" id="strand-gas" value="GAS" required autocomplete="off"
                                        {{ $student->strand == 'GAS' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary text-start d-flex align-items-start" for="strand-gas">
                                        <i class="bi bi-layout-text-window-reverse me-2"></i>
                                        <div>
                                            <strong>GAS</strong><br>
                                            <small>General Academic Strand</small>
                                        </div>
                                    </label>
                                </div>
                            
                                <div class="ps-0 form-check">
                                    <input class="btn-check" type="radio" name="strand" id="strand-ict" value="ICT" required autocomplete="off"
                                        {{ $student->strand == 'ICT' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary text-start d-flex align-items-start" for="strand-ict">
                                        <i class="bi bi-code-slash me-2"></i>
                                        <div>
                                            <strong>ICT</strong><br>
                                            <small>Information and Communications Technology</small>
                                        </div>
                                    </label>
                                </div>
                            
                                <div class="ps-0 form-check">
                                    <input class="btn-check" type="radio" name="strand" id="strand-he" value="HE" required autocomplete="off"
                                        {{ $student->strand == 'HE' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary text-start d-flex align-items-start" for="strand-he">
                                        <i class="bi bi-house-door-fill me-2"></i>
                                        <div>
                                            <strong>HE</strong><br>
                                            <small>Home Economics</small>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            @error('strand')
                                <span class="text-danger fw-bold" style="font-size:10px;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- Section --}}
                <div class="row d-flex">
                    <div class="col-3">
                        <p>Section <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-9 d-flex justify-content-even gap-3">
                        <div class="col">
                            <input type="text" name="section" placeholder="Section" value="{{ old('section')?old('section'):$student->section->name }}"
                                class="form-control @error('section'){{ $class }}@enderror">
                            @error('section')
                                <span class="text-danger fw-bold" style="font-size:10px;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-end pb-5">
                    <button type="submit" class="btn btn-success"><i class="bi bi-cloud-download"></i> Save Changes</button>
                </div>
            </form>
        </div>




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
                if (data.faculties.status == 'active') {
                    $('.status')
                        .prop('checked', true)                  // set the checkbox state
                        .trigger('change');
                } else {
                    $('#estatus')
                        .prop('checked', false)                  // set the checkbox state
                        .trigger('change');
                }
                $('.email').val(data.faculties.user.email);
                $('.semester_id').val(data.faculties.semester.id).change();
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