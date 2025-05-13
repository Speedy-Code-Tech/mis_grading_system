<!-- STUDENT INFORMATION -->
<div id="box2" class="container mx-2 px-2 position-relative" style="min-height: 600px;">
    <h3 class="m-0">Student Information</h3>
    <p class="text-secondary">
        Already registered? 
        <a href="/student/login" style="color:#189993">Sign In</a>
    </p>

    <!-- Grade Level Selection -->
    <div class="container-fluid mt-3">
        <div class="h6 fw-bold mb-3">Select Grade Level</div>
        <div class="container-fluid d-flex justify-content-around align-items-center">
            @foreach (['11' => 'Grade 11', '12' => 'Grade 12'] as $value => $label)
                <div class="container border rounded p-2 m-2 d-flex level justify-content-center align-items-center text-center"
                    style="cursor: pointer; font-size: 14px;"
                    value="{{ $value }}">
                    {{ $label }}
                </div>
            @endforeach
        </div>

        <input id="level" type="hidden" name="level">
        <input id="strands" type="hidden" name="strand">
    </div>

    <!-- Strand Selection -->
    <div class="container-fluid gap-2 d-flex flex-column justify-content-center align-items-start mt-4">
        <h6 class="fw-bold mb-3">Choose Your Strand</h6>
        <div class="container gap-2 d-flex flex-column justify-content-center align-items-start" style="height: 300px;">
            @foreach ($strands as $strand)
                <div strand="{{ $strand->id }}"
                    class="strand flex-shrink-0 container border rounded d-flex gap-3 p-2 align-items-center">
                    <div class="image-wrapper">
                        <img src="{{ asset('img/' . strtolower($strand->course_code) . '.png') }}"
                             alt="{{ $strand->course_code }} Logo"
                             class="strand-image" />
                    </div>
                    <div class="container">
                        <h6 class="fw-bold m-0">{{ $strand->course_code }}</h6>
                        <p class="text-secondary m-0" style="font-size: 12px;">{{ $strand->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="container-fluid d-flex justify-content-between px-4 position-absolute bottom-0 w-100">
        <div id="back" class="btn text-white px-3 py-2 btn-sm" style="background:#6c757d;">
            Previous
        </div>
        <div id="step2" class="btn text-white px-3 py-2 btn-sm" style="background: #189993;">
            Continue
        </div>
    </div>
</div>
<!-- END OF STUDENT INFORMATION -->