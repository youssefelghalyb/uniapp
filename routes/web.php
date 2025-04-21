<?php

use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\AdvisorDashboardController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('students', StudentController::class)->names('students');
    Route::resource('advisors', AdvisorController::class)->names('advisors');
    Route::resource('courses', CourseController::class)->names('courses');
    Route::resource('topics', TopicController::class)->names('topics');
    Route::resource('users', UserController::class)->names('users');    
    Route::resource('branches', BranchController::class)->names('branches');    



    Route::get('contact-list', [DashboardController::class, 'contactsList'])->name('contacts.list');

    Route::get('contact', [DashboardController::class, 'contact'])->name('contact');
    Route::post('contact', [DashboardController::class, 'contactPost'])->name('contact.send');


    Route::get('departments',  [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('departments/create',  [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('departments/store',  [DepartmentController::class, 'store'])->name('departments.store');
    Route::delete('departments/delete/{id}',  [DepartmentController::class, 'destroy'])->name('departments.delete');
    Route::get('departments/edit/{id}',  [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::post('departments/update/{id}',  [DepartmentController::class, 'update'])->name('departments.update');



    Route::get('/meetings', [MonitorController::class, 'indexMeetings'])->name('meetings.index');
Route::get('/meetings/{meeting}', [MonitorController::class, 'showMeeting'])->name('meetings.show');

// Request routes
Route::get('/requests', [MonitorController::class, 'indexRequests'])->name('requests.index');
Route::get('/requests/{request}', [MonitorController::class, 'showRequest'])->name('requests.show');






    //Student Dashboard 
    Route::prefix('student-dashboard')->group(function () {
        Route::get('/', [StudentDashboardController::class, 'dashboard'])->name('student-dashboard');
        Route::get('/requests', [StudentDashboardController::class, 'newRequest'])->name('student-requests.index');
        Route::post('/requests', [StudentDashboardController::class, 'storeRequest'])->name('student-requests.store');
        Route::get('/requests/{request}', [StudentDashboardController::class, 'showRequest'])->name('student-requests.show');
        Route::delete('/requests/{request}', [StudentDashboardController::class, 'destroyRequest'])->name('student-requests.destroy');


        Route::get('/meetings', [StudentDashboardController::class, 'meetings'])->name('student-meetings.index');
        Route::post('/meetings', [StudentDashboardController::class, 'storeMeeting'])->name('student-meetings.store');
        Route::get('/meetings/{meeting}', [StudentDashboardController::class, 'showMeeting'])->name('student-meetings.show');
        Route::delete('/meetings/{meeting}', [StudentDashboardController::class, 'destroyMeeting'])->name('student-meetings.destroy');
        Route::patch('/meetings/{meeting}/reschedule', [StudentDashboardController::class, 'rescheduleMeeting'])->name('student-meetings.reschedule');

        Route::get('/faq', [StudentDashboardController::class, 'faq'])->name('student-faq.index');
    });


    // Advisor Dashboard
    Route::prefix('advisor-dashboard')->group(function () {
        Route::get('/', [AdvisorDashboardController::class, 'dashboard'])->name('advisor-dashboard');
        Route::get('/requests', [AdvisorDashboardController::class, 'myRequests'])->name('advisor-requests.index');
        Route::get('/requests/{request}', [AdvisorDashboardController::class, 'showRequest'])->name('advisor-requests.show');
        Route::post('/requests/answer/{request}',  [AdvisorDashboardController::class, 'answerRequest'])->name('advisor-requests.answer');


        Route::get('/meetings', [AdvisorDashboardController::class, 'myMeetings'])->name('advisor-meetings.index');
        Route::get('/meetings/{meeting}', [AdvisorDashboardController::class, 'showMeeting'])->name('advisor-meetings.show');
        Route::post('/meetings/response/{meeting}', [AdvisorDashboardController::class, 'storeResponse'])->name('advisor-meetings.response');

        Route::get('/faq', [AdvisorDashboardController::class, 'faq'])->name('advisor-faq.index');
        Route::post('/faq', [AdvisorDashboardController::class, 'storeFaq'])->name('advisor-faq.store');
    });
});






require __DIR__ . '/auth.php';
