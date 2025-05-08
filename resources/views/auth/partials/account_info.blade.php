   {{-- ACCOUNT INFORMATION --}}
   <div id="box3" class=" container h-75 mx-1 px-1 pt-5">
    <h3 class="m-0">Set up your Account Information</h3>
    <p class="text-secondary">Want to go back? <a href="/student/login" style="color:#189993">Sign In</a>
    </p>
    <div class="mt-2 container-fluid d-flex gap-2 flex-column justify-content-around">
        <div class="row">
            <div class="row-p-0 m-0 d-flex"><label for="" class="fw-bold h6 m-0">Full
                    Name</label> <span id="errorname" class="text-danger ps-2"></span></div>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col">
                    <input id="fname" name="fname" required placeholder="First Name" type="text"
                        class="form-control">
                </div>
                <div class="col">
                    <input name="mname" id="mname" placeholder="Middle Name" type="text"
                        class="form-control">
                </div>
                <div class="col">
                    <input name="lname" id="lname" required placeholder="Last Name" type="text"
                        class="form-control">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row-p-0 m-0 d-flex">
                <label for="" class="fw-bold h6 m-0">Section</label> 
                <span class="text-danger ps-2" id="errorsection"></span>
            </div>
            <select name="section" id="section" class="form-control">
                <option value="" class="form-control" disabled selected >Select Section</option>
                @foreach ($sections as $section)
                    <option value="{{ $section->id }}" {{ old('section') == $section->id ? 'selected' : '' }} class="form-control">{{ $section->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="row mt-3 d-flex">
            <div class="col">
                <div class="row-p-0 m-0 d-flex"><label for="" class="fw-bold h6 m-0">Gender</label> <span
                        class="text-danger ps-2" id="errorgender"></span></div>
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col">
                        <select class="form-control" name="gender" id="gender">
                            <option selected disabled>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row-p-0 m-0 d-flex"><label for="" class="fw-bold h6 m-0">Birthdate</label> <span
                        class="text-danger ps-2" id="errorbdate"></span></div>
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col">
                        <input type="date" name="bdate" id="bdate" placeholder="Select"
                            class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="row-p-0 m-0 d-flex"><label for="" class="fw-bold h6 m-0">Email</label> <span
                        class="text-danger ps-2" id="erroremail"></span></div>
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col">
                        <input type="email" name="email" id="email" placeholder="Email"
                            class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="row-p-0 m-0 d-flex"><label for="" class="fw-bold h6 m-0">Contact No.</label>
                    <span class="text-danger ps-2" id="errorcontact"></span>
                </div>
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col">
                        <input type="number" min="11" placeholder="09xxxxxxxx3" id="contact" name="contact"
                            class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="row-p-0 m-0 d-flex"><label for="" class="fw-bold h6 m-0">Password</label> <span
                        class="text-danger ps-2" id="errorpassword"></span></div>
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col">
                        <input type="password" id="password" name="password"
                            placeholder="Create new Password" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-end p-4">
        <div id='step3' class="btn text-white px-4 py-3" style="background:#189993; ">Submit <img
                style="width:20px; margin-top:-3px" src="{{ asset('img/arrow.png') }}" /></div>
    </div>
</div>
{{-- END OF ACCOUNT INFORMATION --}}