<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\ShowcaseController;

/*
|--------------------------------------------------------------------------
| Web Routes - MitraDidik
|--------------------------------------------------------------------------
*/

// Halaman Utama & Autentikasi
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->isAdmin()) return redirect()->route('admin.dashboard');
        if ($user->isTeacher()) return redirect()->route('teacher.dashboard');
        if ($user->isGuardian()) return redirect()->route('guardian.dashboard');
    }
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Showcase Komponen UI & Brand Guide (Bisa dibuka untuk review/demo)
Route::get('/components-preview', [ShowcaseController::class, 'index'])->name('components.preview');

// 1. Group Route Khusus Administrator Sekolah (RBAC: admin)
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/school', [AdminController::class, 'school'])->name('school');
    Route::post('/school', [AdminController::class, 'updateSchool'])->name('school.update');
    Route::get('/classes', [AdminController::class, 'classes'])->name('classes');
    Route::get('/subjects', [AdminController::class, 'subjects'])->name('subjects');
    Route::get('/class-teachers', [AdminController::class, 'classTeachers'])->name('class-teachers');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/student-guardians', [AdminController::class, 'studentGuardians'])->name('student-guardians');
    Route::get('/audit-logs', [AdminController::class, 'auditLogs'])->name('audit-logs');
});

// 2. Group Route Khusus Guru (RBAC: teacher)
Route::prefix('teacher')->middleware(['auth', 'role:teacher'])->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
    Route::get('/attendance', [TeacherController::class, 'dashboard'])->name('attendance');
    Route::get('/leave-requests', [TeacherController::class, 'dashboard'])->name('leave-requests');
    Route::get('/assignments', [TeacherController::class, 'dashboard'])->name('assignments');
    Route::get('/grades', [TeacherController::class, 'dashboard'])->name('grades');
    Route::get('/behavior', [TeacherController::class, 'dashboard'])->name('behavior');
    Route::get('/chat', [TeacherController::class, 'dashboard'])->name('chat');
});

// 3. Group Route Khusus Orang Tua / Wali Murid (RBAC: guardian)
Route::prefix('guardian')->middleware(['auth', 'role:guardian'])->name('guardian.')->group(function () {
    Route::get('/dashboard', [GuardianController::class, 'dashboard'])->name('dashboard');
    Route::get('/attendance', [GuardianController::class, 'dashboard'])->name('attendance');
    Route::get('/leave-request', [GuardianController::class, 'dashboard'])->name('leave-request');
    Route::get('/assignments', [GuardianController::class, 'dashboard'])->name('assignments');
    Route::get('/grades', [GuardianController::class, 'dashboard'])->name('grades');
    Route::get('/behavior', [GuardianController::class, 'dashboard'])->name('behavior');
    Route::get('/chat', [GuardianController::class, 'dashboard'])->name('chat');
});
