<div class="h-100 d-flex flex-column overflow-hidden" style="height:100%; width:100%; background: #17908B;">
    <div class="container d-flex justify-content-center align-items-center pt-4 p-2">
        <img style="border-radius: 50%; width:120px;" src="{{ asset("img/logo.jpg") }}"/>
    </div>
    
    <div class="container d-flex flex-column gap-2 pt-3 pe-0" style="overflow-y: auto; height: calc(100vh - 200px);">
      
        <a href="{{ route('teacher.index') }}" 
            class="{{ $active == 'my_classes' ? 'active' : '' }} py-1 ps-3 fw-normal ms-4 rounded-start"
            style="text-decoration: none; font-size: 1.2em;">
            <i class="pe-2 bi bi-grid-1x2-fill"></i> 
            My Classes
        </a>
        <!-- {{-- <a href="{{ route('semester.index') }}" class="{{ $active=='semester'?'active':'' }} p-2 ps-3 fw-bold ms-4 rounded-start" style="text-decoration: none; font-size: 1.2em;"><i class="pe-2 bi bi-calendar2-week"></i> Semester</a> --}} -->
        <!-- {{-- <p class="text-white fw-bold m-0">DEPARTMENT SECTION</p> -->
        <!-- <a href="{{ route('department.index') }}" class="{{ $active=='department'?'active':'' }} p-2 ps-3 fw-bold ms-4 rounded-start" style="text-decoration: none; font-size: 1.2em;"><i class="pe-2 bi bi-upc"></i> Department</a>
        <a href="{{ route('faculty.index') }}" class="{{ $active=='faculty'?'active':'' }} p-2 ps-3 fw-bold ms-4 rounded-start" style="text-decoration: none; font-size: 1.2em;"><i class="pe-2 bi bi-intersect"></i> Faculty</a> --}} -->
        <!-- <p class="text-white fw-bold m-0">STUDENT SECTION</p> -->
        <!-- {{-- <a href="{{ route('student.index') }}" class="{{ $active=='student'?'active':'' }} p-2 ps-3 fw-bold ms-4 rounded-start" style="text-decoration: none; font-size: 1.2em;"><i class="pe-2 bi bi-person-vcard"></i> Student</a> --}} -->
        <!-- <a href="{{ route('teacher.subject.index') }}" class="{{ $active=='subject'?'active':'' }} p-2 ps-3 fw-bold ms-4 rounded-start" style="text-decoration: none; font-size: 1.2em;"><i class="pe-2 bi bi-book-half"></i> Subject</a>
        <p class="text-white fw-bold m-0">GRADING SECTION</p> -->
        <!-- <a href="{{ route('teacher.grades.grade') }}" class="{{ $active=='grades'?'active':'' }} p-2 ps-3 fw-bold ms-4 rounded-start" style="text-decoration: none; font-size: 1.2em;"><i class="pe-2 bi bi-calculator"></i> Enter Grades</a> -->
    </div>

    <form method="POST" action="{{ route('logout') }}"
        class="mt-auto" 
        style="text-decoration: none; font-size: 1.2em; position: sticky; bottom: 10px;"
    >
        @csrf
        <button class="btn btn-danger py-1 fw-normal ms-4 rounded-start w-100">
            <i class="bi bi-box-arrow-left"></i> Logout
        </button>
    </form>
</div>
<style>
    a{
        color:whitesmoke;
    }
    .active{
        color:#17908B;
        background: whitesmoke;
        padding-left:10px;
        padding-top:5px;
        padding-bottom:5px;
        transition: 0.5s;
    }
    </style>