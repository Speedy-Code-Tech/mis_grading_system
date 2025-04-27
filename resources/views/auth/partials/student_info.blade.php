  {{-- STUDENT INFORMATION --}}
  <div id="box2" class=" container h-100 mx-2 pt-5 px-2">
    <h3 class="m-0">Set up your Student Information</h3>
    <p class="text-secondary">Want to go back? <a href="/student/login" style="color:#189993">Sign In</a>
    </p>
    <div class="container-fluid mt-3">
        <div class="h4">Grade Level</div>
        <div class="container-fluid d-flex justify-content-around align-items-center">
            <div class="container border rounded p-3 m-4 d-flex level justify-content-center align-items-center text-center"
                value="11">
                Grade 11
            </div>
            <div class="container border rounded p-3 m-4 d-flex level justify-content-center align-items-center text-center"
                value="12">
                Grade 12
            </div>
        </div>
        <input id="level" type="hidden" name="level">
        <input id="strands" type="hidden" name="strand">
    </div>
   
    <div class="container-fluid gap-2 d-flex flex-column justify-content-center align-items-start">
        <h4>Strand</h4>
        <div class="container  gap-2 d-flex flex-column justify-content-center align-items-start"
            style="height:250px; overflow-y: scroll">
            <div class=" flex-shrink-0 container border rounded d-flex gap-3 p-3 align-items-center"
                style="opacity: 0">
                <img src="{{ asset('img/abm.png') }}" style="width:40px; height:40px;" />
                <div class="container ">
                    <h5 class="fw-bold">ABM</h5>
                    <p class="text-secondary m-0">Accountancy, Business, and Management</p>
                </div>
            </div>
            <div class=" flex-shrink-0 container border rounded d-flex gap-3 p-3 align-items-center"
                style="opacity: 0">
                <img src="{{ asset('img/abm.png') }}" style="width:40px; height:40px;" />
                <div class="container ">
                    <h5 class="fw-bold">ABM</h5>
                    <p class="text-secondary m-0">Accountancy, Business, and Management</p>
                </div>
            </div>
            <div class=" flex-shrink-0 container border rounded d-flex gap-3 p-3 align-items-center"
                style="opacity: 0">
                <img src="{{ asset('img/abm.png') }}" style="width:40px; height:40px;" />
                <div class="container ">
                    <h5 class="fw-bold">ABM</h5>
                    <p class="text-secondary m-0">Accountancy, Business, and Management</p>
                </div>
            </div>

            <div strand="ABM"
                class="strand flex-shrink-0 container border rounded d-flex gap-3 p-3 align-items-center">
                <img src="{{ asset('img/abm.png') }}" style="width:40px; height:40px;" />
                <div class="container ">
                    <h5 class="fw-bold">ABM</h5>
                    <p class="text-secondary m-0">Accountancy, Business, and Management</p>
                </div>
            </div>
            <div strand="STEM"
                class="strand flex-shrink-0 container border rounded d-flex gap-3 p-3 align-items-center">
                <img src="{{ asset('img/stem.png') }}" style="width:40px; height:40px;" />
                <div class="container ">
                    <h5 class="fw-bold">STEM</h5>
                    <p class="text-secondary m-0">Science, technology, engineering, and mathematics</p>
                </div>
            </div>
            <div strand="HUMSS"
                class="strand flex-shrink-0 container border rounded d-flex gap-3 p-3 align-items-center">
                <img src="{{ asset('img/humss.png') }}" style="width:40px; height:40px;" />
                <div class="container ">
                    <h5 class="fw-bold">HUMSS</h5>
                    <p class="text-secondary m-0">Humanities and Social Sciences</p>
                </div>
            </div>
            <div strand="GAS"
                class="strand flex-shrink-0 container border rounded d-flex gap-3 p-3 align-items-center">
                <img src="{{ asset('img/gas.png') }}" style="width:40px; height:40px;" />
                <div class="container ">
                    <h5 class="fw-bold">GAS</h5>
                    <p class="text-secondary m-0">General Academic Strand</p>
                </div>
            </div>
            <div strand="ICT"
                class="strand flex-shrink-0 container border rounded d-flex gap-3 p-3 align-items-center">
                <img src="{{ asset('img/ict.png') }}" style="width:40px; height:40px;" />
                <div class="container ">
                    <h5 class="fw-bold">ICT</h5>
                    <p class="text-secondary m-0">Information and communication technology</p>
                </div>
            </div>
            <div strand="HE"
                class="strand flex-shrink-0 container border rounded d-flex gap-3 p-3 align-items-center">
                <img src="{{ asset('img/he.png') }}" style="width:40px; height:40px; : " />
                <div class="container ">
                    <h5 class="fw-bold">HE</h5>
                    <p class="text-secondary m-0">Home economics</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid text-end p-4">
        <div id='step2' class="btn text-white px-4 py-3" style="background:#189993; ">Submit <img
                style="width:20px; margin-top:-3px" src="{{ asset('img/arrow.png') }}" /></div>
    </div>
</div>
{{-- END OF STUDENT INFORMATION --}}