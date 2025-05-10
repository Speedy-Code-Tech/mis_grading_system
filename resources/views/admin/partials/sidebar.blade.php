<div class=" h-100 d-flex flex-column" style="height:100%; width:100%; background: #17908B;">
    <div class="container d-flex justify-content-center align-items-center pt-4 p-2">
        <img style="border-radius: 50%; width:120px;" src="{{ asset("img/logo.jpg") }}"/>
    </div>
    <div class="container d-flex flex-column gap-2 pt-3 pe-0">
        <!-- current active:    {{ $active }} -->
        <a href="{{ route('admin.dashboard') }}" class="{{ $active=='dashboard'?'active':'' }} py-1 ps-3 fw-normal ms-4 rounded-start" style="text-decoration: none; font-size: 1.2em;"><i class="pe-2 bi bi-grid-1x2-fill"></i> Dashboard</a>
        <a href="" class="{{ $active=='school_year'?'active':'' }} py-1 ps-3 fw-normal ms-4 rounded-start" style="text-decoration: none; font-size: 1.2em;"><i class="pe-2 bi bi-calendar2-week"></i> School Year</a>
        <a href="{{ route('semester.index') }}" class="{{ $active=='semester'?'active':'' }} py-1 ps-3 fw-normal ms-4 rounded-start" style="text-decoration: none; font-size: 1.2em;"><i class="pe-2 bi bi-calendar2-week"></i> Semester</a>
        
        <p class="text-center text-white fw-bold m-0">TRACK & GRADE LEVEL</p>
        
        <a href="{{ route('department.index') }}" class="{{ $active=='track'?'active':'' }} py-1 ps-3 fw-normal ms-4 rounded-start" style="text-decoration: none; font-size: 1.2em;"><i class="pe-2 bi bi-upc"></i> Track</a>
        <a href="" class="{{ $active=='grade_level'?'active':'' }} py-1 ps-3 fw-normal ms-4 rounded-start" style="text-decoration: none; font-size: 1.2em;"><i class="pe-2 bi bi-upc"></i> Grade Level</a>
        
        <p class="text-center text-white fw-bold m-0">STUDENT SECTION</p>
        
        <!-- <a href="" class="{{ $active=='section'?'active':'' }} py-1 ps-3 fw-normal ms-4 rounded-start" style="text-decoration: none; font-size: 1.2em;"><i class="pe-2 bi bi-book-half"></i> Section</a> -->
        <a href="{{ route('subject.index') }}" class="{{ $active=='subject'?'active':'' }} py-1 ps-3 fw-normal ms-4 rounded-start" style="text-decoration: none; font-size: 1.2em;"><i class="pe-2 bi bi-book-half"></i> Subject</a>
        
        <p class="text-center text-white fw-bold m-0">MANAGE ACCOUNT</p>
        
        <a href="{{ route('student.index') }}" class="{{ $active=='student'?'active':'' }} py-1 ps-3 fw-normal ms-4 rounded-start" style="text-decoration: none; font-size: 1.2em;"><i class="pe-2 bi bi-person-vcard"></i> Student</a>
        <a href="{{ route('faculty.index') }}" class="{{ $active=='faculty'?'active':'' }} py-1 ps-3 fw-normal ms-4 rounded-start" style="text-decoration: none; font-size: 1.2em;"><i class="pe-2 bi bi-intersect"></i> Teachers</a>
        
        <p class="text-center text-white fw-bold m-0">GRADING SECTION</p>
        
        <a href="" class="py-1 ps-3 fw-normal ms-4 rounded-start" style="text-decoration: none; font-size: 1.2em;"><i class="bi bi-calculator"></i> Grading</a>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn text-danger py-1 ps-3 fw-normal ms-4 rounded-start" style="position: absolute; bottom:20px; text-decoration: none; font-size: 1.2em;"><i class="bi bi-box-arrow-left"></i> Logout</button>
        </form>
    </div>
</div>