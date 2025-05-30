<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HeadTeacherController;
use App\Http\Controllers\HeadTeacherSubjectController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentSubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherSubjectController;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->middleware(['checkAuth:admin']);


Route::group(['prefix' => 'teacher'], function () {
    Auth::routes();
});
Route::group(['prefix' => 'head'], function () {
    Auth::routes();
});
Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
});
Route::group(['prefix' => 'student'], function () {
    Auth::routes();
    Route::post('/registration', [StudentController::class, 'create'])->name('registration');
});


Route::group(['prefix' => 'admin', 'middleware' => ['checkAuth:admin']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard/strand', [DashboardController::class, 'strand'])->name('admin.dashboard.strand');
    Route::get('/dashboard/faculty', [DashboardController::class, 'faculty'])->name('admin.dashboard.faculty');
    Route::get('/dashboard/student', [DashboardController::class, 'student'])->name('admin.dashboard.student');
    Route::get('/dashboard/student/{level}/{track}', [DashboardController::class, 'studentDetails'])->name('admin.dashboard.student-details');
    Route::get('/dashboard/subject', [DashboardController::class, 'subject'])->name('admin.dashboard.subject');
    Route::get('/dashboard/subject/{level}/{track}', [DashboardController::class, 'subjectDetails'])->name('admin.dashboard.subject-details');

    Route::prefix('/semester')->group(function () {
        Route::get('/', [SemesterController::class, 'index'])->name('semester.index');
        Route::post('/store', [SemesterController::class, 'store'])->name('semester.store');
        Route::get('/destroy/{id}', [SemesterController::class, 'destroy'])->name('semester.destroy');
        Route::get('/edit/{id}', [SemesterController::class, 'edit'])->name('semester.edit');
        Route::post('/edit/{semester}', [SemesterController::class, 'update'])->name('semester.updates');
    });

    Route::prefix('/department')->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('department.index');
        Route::post('/store', [DepartmentController::class, 'store'])->name('department.store');
        Route::get('/destroy/{department}', [DepartmentController::class, 'destroy'])->name('department.destroy');
        Route::get('/edit/{department}', [DepartmentController::class, 'edit'])->name('department.edit');
        Route::post('/edit/{department}', [DepartmentController::class, 'update'])->name('department.updates');
    });

    Route::prefix('/faculty')->group(function () {
        Route::get('/', [FacultyController::class, 'index'])->name('faculty.index');
        Route::post('/store', [FacultyController::class, 'store'])->name('faculty.store');
        Route::get('/destroy/{faculty}', [FacultyController::class, 'destroy'])->name('faculty.destroy');
        Route::get('/edit/{faculty}', [FacultyController::class, 'show'])->name('faculty.edit');
        Route::post('/update/{faculty}', [FacultyController::class, 'update'])->name('faculty.updates');
    });

    Route::prefix('/student')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('student.index');
        Route::get('/create', [StudentController::class, 'insert'])->name('student.create');
        Route::post('/store', [StudentController::class, 'create'])->name('student.store');
        Route::get('/destroy/{student}', [StudentController::class, 'destroy'])->name('student.destroy');
        Route::get('/edit/{student_id}', [StudentController::class, 'show'])->name('student.edit');
        Route::get('/view/{student_id}', [StudentController::class, 'view'])->name('student.view');
        Route::post('/edit/{student}', [StudentController::class, 'update'])->name('student.update');

        Route::get('/view-grades/{student_id}', [StudentController::class, 'viewGrades'])->name('admin.students.grades');
        Route::post('/importStudent', [StudentController::class, 'importStudent'])->name('student.import');
    });


    Route::prefix('/subject')->group(function () {
        Route::get('/', [SubjectController::class, 'index'])->name('subject.index');
        Route::post('/store', [SubjectController::class, 'store'])->name('subject.store');
        Route::get('/destroy/{subject}', [SubjectController::class, 'destroy'])->name('subject.destroy');
        Route::get('/edit/{subject}', [SubjectController::class, 'show'])->name('subject.edit');
        Route::post('/edit/{subject}', [SubjectController::class, 'update'])->name('subject.updates');
        
        Route::get('/assign-subject', [SubjectController::class, 'teacherAssignment'])->name('assign-subjects.index');
        Route::post('/storeAssignment', [SubjectController::class, 'storeAssignment'])->name('assign-subjects.store');
    });
});

Route::group(['prefix' => 'student', 'checkAuth:student'], function () {
    Route::post('/registration', [StudentController::class, 'create'])->name('registration');
    Route::get('/dashboard', [StudentController::class, 'student'])->name('student.indexs');
    Route::get('/subject', [StudentSubjectController::class, 'index'])->name('student.subject.index');
});

Route::group(['prefix' => 'teacher', 'middleware' => ['checkAuth:teacher']], function () {
    Route::get('/dashboard', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('/subject', [TeacherSubjectController::class, 'index'])->name('teacher.subject.index');
    Route::get('/grades', [TeacherSubjectController::class, 'grades'])->name('teacher.grades.grade');
    
    Route::post('/grades/save', [TeacherSubjectController::class, 'store'])->name('teacher.grades.save');
    Route::post('/grades/update', [TeacherSubjectController::class, 'update'])->name('teacher.grades.update');

    Route::get('/dashboard/grades/exportGradesCsv/{uuid}', [TeacherController::class, 'exportGradesCsv'])->name('teacher.grade.exportGradesCsv');
    Route::get('/dashboard/grades/view/{uuid}', [TeacherController::class, 'show'])->name('teacher.grade.view');
    Route::get('/dashboard/grades/edit/{uuid}', [TeacherController::class, 'inputGrades'])->name('teacher.grade.edit');
});



Route::group(['prefix' => 'head', 'middleware' => ['checkAuth:head_teacher']], function () {

    Route::get('/dashboard', [HeadTeacherController::class, 'index'])->name('head.index');
    Route::get('/subject', [HeadTeacherSubjectController::class, 'index'])->name('head.subject.index');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
