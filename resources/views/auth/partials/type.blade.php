{{-- REGISTRATION TYPE --}}
<div id="box1" class="container h-75 mx-1 px-1">
    <h3 class="m-0">Registration Type Selection</h3>
    <p class="text-secondary">
        Already registered? 
        <a href="/student/login" style="color:#189993">Sign In</a>
    </p>

    <div class="mt-5 pt-5 container-fluid d-flex gap-5 justify-content-around">
        <div id="newStudent" class="container border rounded p-3 m-1 d-flex option" value="new">
            <img class="img-fluid py-3" style="width:100px; height:100px;" src="{{ asset('img/active_notebook.png') }}" alt="New Student Icon" />
            <div class="container">
                <h4 style="color:#189993">New Student</h4>
                <p>If this is your first time registering, click below to proceed with the enrollment process.</p>
            </div>
        </div>

        <div id="oldStudent" class="container border rounded p-3 m-1 d-flex option" value="old">
            <img class="img-fluid py-3" style="width:100px; height:100px;" src="{{ asset('img/old_notebook.png') }}" alt="Returning Student Icon" />
            <div class="container">
                <h4 style="color:#189993">Returning Student</h4>
                <p>If you are a returning student, click below to proceed with re-enrollment.</p>
            </div>
        </div>
    </div>

    <input id="type" type="hidden" name="type">

    <div class="container-fluid d-flex justify-content-end px-4 w-100 mt-3">
        <div id="step1" class="btn text-white px-3 py-2 btn-sm" style="background: #189993;">
            Continue
        </div>
    </div>
</div>
{{-- END OF REGISTRATION TYPE --}}