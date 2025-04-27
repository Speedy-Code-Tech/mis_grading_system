     {{-- RESIDENTIAL INFORMATION --}}
     <div id="box4" class=" container h-75 mx-1 px-1">
        <h3 class="m-0">Set up your Residential Information</h3>
        <p class="text-secondary">Want to go back? <a href="/student/login" style="color:#189993">Sign In</a>
        </p>
        <div class="mt-2 container-fluid d-flex gap-2 flex-column justify-content-around">

            <div class="row mt-3">
                <div class="col">
                    <div class="row-p-0 m-0 d-flex"><label for="" class="fw-bold h6 m-0">Street Address</label>
                        <span class="text-danger ps-2" id="errorstreet"></span>
                    </div>
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col">
                            <input required type="text" name="street" id="street"
                                placeholder="Enter Your Street" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="row-p-0 m-0 d-flex"><label for="" class="fw-bold h6 m-0">Region</label> <span
                            class="text-danger ps-2" id="errorregion"></span></div>
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col">
                            <input required type="text" name="region" id="region"
                                placeholder="Enter Your Region (I,II,III,...)" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="row-p-0 m-0 d-flex"><label for="" class="fw-bold h6 m-0">Province</label> </div>
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col">
                            <input required type="text" name="province" id="province"
                                placeholder="Ex. Camarines Norte" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="row-p-0 m-0 d-flex"><label for="" class="fw-bold h6 m-0">City</label> </div>
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col">
                            <input required type="text" name="city" id="city" placeholder="Ex. Daet"
                                class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="row-p-0 m-0 d-flex"><label for="" class="fw-bold h6 m-0">Barangay</label> </div>
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col">
                            <input required type="text" name="brgy" id="brgy" placeholder="Ex. Gubat"
                                class="form-control">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid text-end p-4">
            <button type="submit" class="btn text-white px-4 py-3" style="background:#189993; ">Submit <img
                    style="width:20px; margin-top:-3px" src="{{ asset('img/arrow.png') }}" /></button>
        </div>
    </div>
    {{-- END OF RESIDENTIAL INFORMATION --}}