       {{-- REGISTRATION TYPE --}}
       <div id="box1" class=" container h-75 mx-1 px-1">
        <h3 class="m-0">Set up your Registration Type</h3>
        <p class="text-secondary">Want to go back? <a href="/student/login" style="color:#189993">Sign In</a>
        </p>
        <div class="mt-5 pt-5 container-fluid d-flex gap-5 justify-content-around">
            <div class="container border rounded p-3 m-1 d-flex option" value="new" id="newStudent">
                <img class="img-fluid py-3" style="width:100px;height:100px;"
                    src="{{ asset('img/active_notebook.png') }}" />
                <div class="container">
                    <h4 style="color:#189993">New Student</h4>
                    <p>Are you a new student? Please click the continue button below to complete your
                        registration.</p>
                </div>
            </div>
            <div class="container border rounded p-3 m-1 d-flex option" value="old" id="oldStudent">
                <img class="img-fluid py-3" style="width:100px;height:100px;"
                    src="{{ asset('img/old_notebook.png') }}" />
                <div class="container">
                    <h4 style="color:#189993">Old Student</h4>
                    <p>Are you an old student? Please click the continue button below to complete your
                        registration.</p>
                </div>
            </div>
        </div>
        <input id="type" type="hidden" name="type">
        <br>
        <br>
        <br>
        <div class="container-fluid text-end p-4">
            <div id='step1' class="btn text-white px-4 py-3" style="background:#189993; ">Submit <img
                    style="width:20px; margin-top:-3px" src="{{ asset('img/arrow.png') }}" /></div>
        </div>
    </div>
    {{-- END OF REGISTRATION TYPE --}}