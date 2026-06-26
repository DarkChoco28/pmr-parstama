<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegController;
use App\Http\Controllers\Admin\DashboardController as AdminDashController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
}) ->middleware(['auth', 'verified']) ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ---------- Routes Pendaftaran ----------
Route::get('/daftar', [RegistrationController::class, 'create'])->name('registration.create');
Route::post('/daftar', [RegistrationController::class, 'store'])->middleware('throttle:5,1')->name('registration.store');
Route::get('/daftar/terima-kasih', [RegistrationController::class, 'thankyou'])->name('registration.thankyou');
Route::get('/cek-status', [RegistrationController::class, 'statusCheck'])->name('registration.status');
Route::post('/cek-status', [RegistrationController::class, 'findStatus'])->middleware('throttle:10,1')->name('registration.status.find');

Route::prefix('admin')->middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashController::class, 'index'])
        ->name('admin.dashboard');
    Route::get('/dashboard/stats', [AdminDashController::class, 'stats'])
        ->name('admin.dashboard.stats');
    Route::post('/dashboard/toggle-registration', [AdminDashController::class, 'toggleRegistration'])
        ->name('admin.dashboard.toggle');
    Route::get('/registrations', [AdminRegController::class, 'index'])
        ->name('admin.registrations.index');
    Route::get('/registrations/export-excel', [AdminRegController::class, 'exportExcel'])
        ->name('admin.registrations.excel');
    Route::get('/registrations/{id}/export-pdf', [AdminRegController::class, 'exportPdf'])
        ->name('admin.registrations.pdf');
    Route::post('/registrations/{id}/status', [AdminRegController::class, 'updateStatus'])
        ->name('admin.registrations.status');
    Route::delete('/registrations/{id}', [AdminRegController::class, 'destroy'])
        ->name('admin.registrations.destroy');
    Route::delete('/registrations', [AdminRegController::class, 'destroyBulk'])
        ->name('admin.registrations.destroyBulk');
});
