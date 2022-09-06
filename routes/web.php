<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\AcademicCalendarController;
use App\Http\Controllers\Admin\AdmissionInformationController;
use App\Http\Controllers\Admin\SyllabusController;
use App\Http\Controllers\Admin\RoutineController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ImportantLinkController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherAssignController;
use App\Http\Controllers\Admin\CreateExamController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\MarkSetupController;
use App\Http\Controllers\Admin\ResultGenerateController;

use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//         return view('front.index');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/back', [HomeController::class, 'back'])->name('page.back');
Route::get('/notice/details/{id}', [HomeController::class, 'notice_details'])->name('notice.details');
Route::get('/department/details/{id}', [HomeController::class, 'department_details'])->name('department.details');
Route::get('/service/details/{id}', [HomeController::class, 'service_details'])->name('service.details');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact/submit', [HomeController::class, 'contact_submit'])->name('submit.contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/about/principal', [HomeController::class, 'about_principal'])->name('about.principal');
Route::get('/faculty', [HomeController::class, 'faculty'])->name('faculty');
Route::get('/office_staffs', [HomeController::class, 'office_staffs'])->name('office_staffs');
Route::get('information/{slag?}', [HomeController::class, 'information'])->name('information');
Route::get('details/information/{slag?}/{id?}', [HomeController::class, 'details_information'])->name('details.information');
Route::get('/principal/message', [HomeController::class, 'principal_message'])->name('principal.message');
Route::get('/image/gallery', [HomeController::class, 'image_gallery'])->name('image.gallery');

// Registration Routes...
Route::get('register',[RegisterController::class, 'showRegistrationForm'])->name('register');


Route::get('/admin/login', [HomeController::class, 'admin_login'])->name('admin.login');
Route::get('/student/login', [HomeController::class, 'student_login'])->name('student.login');
Route::get('/student/register', [HomeController::class, 'student_register'])->name('student.register');
Route::get('/student/register/check/{ssc_roll?}/{section_id?}', [HomeController::class, 'student_register_check'])->name('check.register.student');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'student_login'])->name('login');


Auth::routes();  
Route::group(['prefix' => 'admin','middleware'=>['admin','auth']], function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/message/list', [App\Http\Controllers\Admin\DashboardController::class, 'message_list'])->name('admin.message.list');
        Route::get('/about/Us', [App\Http\Controllers\Admin\DashboardController::class, 'about_us'])->name('admin.about_us');
        Route::get('/principal/about/Us', [App\Http\Controllers\Admin\DashboardController::class, 'principal_us'])->name('admin.principal_us');
        Route::post('/about/Us/submit', [App\Http\Controllers\Admin\DashboardController::class, 'about_us_submit'])->name('admin.about_us.submit');
        Route::get('/teachers/list', [DashboardController::class, 'teachers_list'])->name('admin.teachers.list');
        Route::get('/students/list', [DashboardController::class, 'students_list'])->name('admin.students.list');
        Route::get('/add/teacher', [DashboardController::class, 'add_teacher'])->name('admin.add.teacher');
        Route::resource('department', DepartmentController::class);
        Route::resource('designation', DesignationController::class);
        Route::resource('employee', EmployeeController::class);
        Route::resource('staff', StaffController::class);

        Route::resource('student', StudentController::class);
        Route::get('/get/student', [StudentController::class, 'get_student'])->name('get.students');
        Route::get('/edit/student/{id}', [StudentController::class, 'edit_student'])->name('edit.student');
        Route::get('/import/student', [StudentController::class, 'import_student'])->name('import.student');
        Route::post('/import/student', [StudentController::class, 'submit_import_student'])->name('submit.import.student');
        Route::post('/change/subject', [StudentController::class, 'change_subject_submit'])->name('change.subject.submit');
        Route::put('/update/student/details/{id}', [StudentController::class, 'student_details_update'])->name('student.details.update');
        Route::get('/students/generate', [StudentController::class, 'student_card_generate'])->name('students.card.generate');
        Route::post('/print/card', [StudentController::class, 'print_card'])->name('print.card');

        Route::resource('notice', NoticeController::class);
        Route::resource('academic_calendar', AcademicCalendarController::class);
        Route::resource('admission_information', AdmissionInformationController::class);
        Route::resource('syllabus', SyllabusController::class);
        Route::resource('routine', RoutineController::class);
        Route::resource('result', ResultController::class);

        Route::resource('service', ServiceController::class);
        Route::resource('service_category', ServiceCategoryController::class);

        Route::resource('banner', BannerController::class);
        Route::resource('gallery', GalleryController::class);
        Route::resource('media', MediaController::class);

        Route::resource('important_link', ImportantLinkController::class);
        Route::resource('subject', SubjectController::class);
        Route::resource('teacher_assign', TeacherAssignController::class);
        Route::resource('section', SectionController::class);
        Route::resource('create_exam', CreateExamController::class);
        Route::resource('mark_setup', MarkSetupController::class);
        Route::resource('result_generate', ResultGenerateController::class);
        Route::get('/result/create/{id}', [ResultGenerateController::class, 'result_create'])->name('result.create');
        Route::post('/result/import', [ResultGenerateController::class, 'result_import'])->name('result-import');
        Route::get('/get/result', [ResultGenerateController::class, 'get_result'])->name('get.result');
        Route::post('/get/exam/result', [ResultGenerateController::class, 'get_result_each_exam'])->name('get.result.each.exam');
        Route::post('/get/section/result', [ResultGenerateController::class, 'get_result_section'])->name('get.result.section');
        Route::post('/get/main/subject/result', [ResultGenerateController::class, 'get_result_main_subject'])->name('get.result.mainSubjectWise');
        Route::get('/get/personal/result/{id}', [ResultGenerateController::class, 'get_personal_result'])->name('get.personal.result');
        Route::post('/subject/choose', [MarkSetupController::class, 'subject_choose'])->name('subject.choose');

});

Route::group(['prefix' => 'user','middleware'=>['user','auth']], function () {
        Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');
        Route::get('/profile', [App\Http\Controllers\User\DashboardController::class, 'profile'])->name('user.profile');
        Route::put('/profile/{update}', [App\Http\Controllers\User\DashboardController::class, 'profile_update'])->name('user.profile.update');
        Route::get('/print/{id}', [App\Http\Controllers\User\DashboardController::class, 'print_adminssion_form'])->name('print.adminssion.form');

        Route::get('/get/history/result/{id}', [App\Http\Controllers\User\DashboardController::class, 'get_result_history'])->name('get.result.history');
        Route::get('/get/result/print/{id}', [App\Http\Controllers\User\DashboardController::class, 'get_result_print'])->name('student.result.print');
});

