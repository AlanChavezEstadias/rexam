<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\ExamPreviewController;
use App\Http\Controllers\Admin\ExamQuestionController;
use App\Http\Controllers\Admin\ExamStepController;
use App\Http\Controllers\SuperAdmin\SuperAdminDashboardController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\User\UserDashboardController;
use Illuminate\Support\Facades\Route;

// Redirigir siempre al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Grupo SuperAdmin
Route::middleware(['auth', 'verified', 'role:SuperAdmin'])->prefix('super-admin')->name('super-admin.')->group(function () {
    Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('dashboard');
    // Usuarios
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::patch('/users/{user}/toggle', [UserController::class, 'toggleStatus'])->name('users.toggle');
});

// Grupo Administrador
Route::middleware(['auth', 'verified', 'role:Administrador'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Exámenes (CRUD Paso 1)
    Route::resource('exams', ExamController::class);
    // Paso 2: Configuración del examen
    Route::get('exams/{exam}/setup', [ExamController::class, 'setup'])->name('exams.setup');
    Route::put('exams/{exam}/setup', [ExamController::class, 'setupStore'])->name('exams.setup.store');
    // Paso 3: Preguntas del examen (CRUD completo)
    Route::resource('exams.questions', ExamQuestionController::class);
    // Paso 4: Pasos previos al examen (CRUD completo)
    Route::resource('exams.steps', ExamStepController::class);
    // Previsualización (Wizard de pasos)
    Route::get('exams/{exam}/preview', [ExamPreviewController::class, 'index'])->name('exams.preview');
    Route::post('exams/{exam}/steps/{step}/complete', [ExamPreviewController::class, 'completeStep'])->name('exams.steps.complete');
});

// Grupo Usuario
Route::middleware(['auth:exam', 'role:Usuario'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

require __DIR__ . '/auth.php';
