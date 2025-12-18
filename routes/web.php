<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// Temporary - DELETE AFTER USE
Route::get('/clear-cache', function() {
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    return 'Cache cleared!';
});

Route::get('/', [StudentController::class, 'certificationForm'])->name('students.certificationForm');
Route::post('/', [StudentController::class, 'showCertification'])->name('students.showCertification');

// Public routes for viewing student data (with hashed ID)
Route::get('/student/{hashedId}', [StudentController::class, 'show'])->name('students.show');
Route::get('/certificate/{hashedId}', [StudentController::class, 'certificate'])->name('students.certificate');

// Admin routes (protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
    Route::get('/admin/create', [StudentController::class, 'create'])->name('students.create');
    Route::get('/admin', [StudentController::class, 'index'])->name('students.index');
    Route::post('/student/store', [StudentController::class, 'store'])->name('students.store');
    Route::get('/admin/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/admin/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::get('/search', [StudentController::class, 'search'])->name('students.search');
    Route::delete('/admin/{hashedId}', [StudentController::class, 'destroy'])->name('students.destroy');
});

// Profile routes
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


// Authentication routes
require __DIR__ . '/auth.php';
