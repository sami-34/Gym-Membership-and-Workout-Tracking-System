<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Password;


use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('landing');



use App\Http\Controllers\AuthController;

// Authentication Routes
Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'loginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'registerForm');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->middleware('auth');
});

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        if ($role == 'admin') return view('dashboards.admin');
        if ($role == 'trainer') return view('dashboards.trainer');
        return view('dashboards.member');
    });
});



use App\Http\Controllers\Auth\ForgotPasswordController;

// Password Reset Routes
Route::controller(ForgotPasswordController::class)->group(function(){
    Route::get('forgot-password', 'showLinkRequestForm')->name('password.request');
    Route::post('forgot-password', 'sendResetLinkEmail')->name('password.email');
});


use App\Http\Controllers\Auth\ResetPasswordController;

Route::controller(ResetPasswordController::class)->group(function(){
    Route::get('reset-password/{token}', 'showResetForm')->name('password.reset');
    Route::post('reset-password', 'reset')->name('password.update');
});




use App\Http\Controllers\DashboardController;

Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    if ($role == 'admin') {
        return app(DashboardController::class)->adminDashboard();
    }

    if ($role == 'trainer') {
        return app(DashboardController::class)->trainerDashboard();
    }

    return app(DashboardController::class)->memberDashboard();
});




use App\Http\Controllers\TrainerViewController;

Route::middleware(['auth'])->group(function () {
    Route::get('/trainers', [TrainerViewController::class, 'index']);
    Route::post('/trainers/select', [TrainerViewController::class, 'selectTrainer']);
    Route::post('/trainers/rate', [TrainerViewController::class, 'rateTrainer']);
    Route::get('/myplan', [TrainerViewController::class, 'myPlan']);
    Route::get('/trainers/recommended', [TrainerViewController::class,'recommended']);
    Route::post('/trainers/unselect', [TrainerViewController::class, 'unselectTrainer']);
    Route::post('/myplan/addplan', [TrainerViewController::class, 'addManualPlan']);
    Route::post('/myplan/autogenerate', [TrainerViewController::class, 'autoGeneratePlan']);
});




use App\Http\Controllers\TrainerProfileController;

Route::middleware(['auth'])->group(function () {
    Route::get('/trainer/profile', [TrainerProfileController::class, 'edit'])->name('trainer.profile.edit');
    Route::post('/trainer/profile', [TrainerProfileController::class, 'update'])->name('trainer.profile.update');
});




use App\Http\Controllers\MembershipController;

Route::middleware(['auth'])->group(function () {
    Route::get('/memberships', [MembershipController::class, 'index'])->name('memberships.index');
    Route::get('/memberships/create', [MembershipController::class, 'create']);
    Route::post('/memberships', [MembershipController::class, 'store']);
    Route::get('/memberships/{id}/edit', [MembershipController::class, 'edit']);
    Route::post('/memberships/{id}', [MembershipController::class, 'update']);
    Route::get('/memberships/{id}/delete', [MembershipController::class, 'destroy']);
});




use App\Http\Controllers\PaymentController;

Route::middleware(['auth'])->group(function () {
    Route::get('/payments', [PaymentController::class, 'index']);
    Route::get('/payments/create', [PaymentController::class, 'create']);
    Route::post('/payments', [PaymentController::class, 'store']);
});




use App\Http\Controllers\WorkoutController;

Route::get('/workouts', [WorkoutController::class, 'index']);
Route::get('/workouts/create', [WorkoutController::class, 'create']);
Route::post('/workouts', [WorkoutController::class, 'store']);




use App\Http\Controllers\DietPlanController;

Route::get('/diets', [DietPlanController::class, 'index']);
Route::get('/diets/create', [DietPlanController::class, 'create']);
Route::post('/diets', [DietPlanController::class, 'store']);




use App\Http\Controllers\MemberWorkoutController;

Route::middleware(['auth'])->group(function () {
    Route::get('/assign-workout', [MemberWorkoutController::class, 'create']);
    Route::post('/assign-workout', [MemberWorkoutController::class, 'store']);
});




use App\Http\Controllers\MemberDietController;

Route::middleware(['auth'])->group(function () {
    Route::get('/assign-diet', [MemberDietController::class, 'create']);
    Route::post('/assign-diet', [MemberDietController::class, 'store']);
});




use App\Http\Controllers\AttendanceController;

Route::get('/attendance/checkin', [AttendanceController::class, 'index']);   // show check-in page
Route::post('/attendance/checkin', [AttendanceController::class, 'checkin']); // handle actual check-in




use App\Http\Controllers\ProgressReportController;

Route::get('/progress', [ProgressReportController::class, 'index']);
Route::post('/progress', [ProgressReportController::class, 'store']);




use App\Http\Controllers\AdminController;
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/attendance', [AdminController::class, 'attendanceReport']);
    Route::get('/admin/manageTrainers', [AdminController::class,'manageTrainers']);
    Route::get('/admin/manageTrainers/{id}/edit', [AdminController::class, 'editTrainer']);
    Route::put('/admin/manageTrainers/{id}', [AdminController::class, 'updateTrainer']);
    Route::delete('/admin/manageTrainers/{id}', [AdminController::class, 'deleteTrainer']);

    Route::get('/admin/reports', [AdminController::class,'reportForm']);
    Route::post('/admin/reports', [AdminController::class,'generateReport']);

    Route::post('/admin/reports/export', [AdminController::class, 'exportPDF'])->name('export.pdf');

});
