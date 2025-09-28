<?php

use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ClassSectionController;
use App\Http\Controllers\Admin\ClassSubjectController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\ExamResultController;
use App\Http\Controllers\Admin\FeeStructureController;
use App\Http\Controllers\Admin\FeeTypeController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\StudentFeeController;
use App\Http\Controllers\Admin\StudentFineController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherAssignmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/frontend/payments', function () {
    return view('frontend.payments');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');
Route::post('admin/login',[AdminController::class,'login'])->name('admin.login.submit');

Route::middleware('admin')->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admins.admin_dashboard');
    Route::post('admin/logout',[AdminController::class,'logout'])->name('admin.logout');
    Route::resource('classes', SchoolClassController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('shifts', ShiftController::class);
    Route::resource('class-sections', ClassSectionController::class);
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('fee_types', FeeTypeController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('enrollments', EnrollmentController::class);
    Route::resource('academic-years', AcademicYearController::class);
    Route::resource('class-subjects', ClassSubjectController::class);
    Route::resource('fee-structures', FeeStructureController::class);
    Route::resource('teacher-assignments', TeacherAssignmentController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::get('attendances/bulk/create', [\App\Http\Controllers\Admin\AttendanceController::class, 'bulkCreate'])->name('attendances.bulk.create');
    Route::post('attendances/bulk/store', [\App\Http\Controllers\Admin\AttendanceController::class, 'bulkStore'])->name('attendances.bulk.store');
    Route::resource('exam-results', ExamResultController::class);
    Route::resource('student-fees', StudentFeeController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('student-fines', StudentFineController::class);
    Route::get('class-sections/{id}/students', [ClassSectionController::class, 'getStudents'])->name('class-sections.students');

});
