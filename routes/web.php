<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\FieldController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LapanganController as AdminLapanganController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

// Welcome / Homepage
Route::get('/', function () {
    return view('landingpage');
});

// Guest Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Customer / User Routes
    Route::get('/fields', [FieldController::class, 'index'])->name('fields.index');
    Route::get('/booking-lapangan/{id}', [FieldController::class, 'show'])->name('booking.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking-history', [BookingController::class, 'history'])->name('bookings.history');
    Route::get('/pembayaran/konfirmasi/{booking}', [PaymentController::class, 'showKonfirmasi'])->name('pembayaran.konfirmasi');
    Route::post('/pembayaran/konfirmasi/{booking}', [PaymentController::class, 'submitPayment'])->name('pembayaran.submit');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Admin Group Protected by AdminMiddleware
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        
        // Fields CRUD
        Route::get('/lapangan', [AdminLapanganController::class, 'index'])->name('admin.lapangan.index');
        Route::post('/lapangan', [AdminLapanganController::class, 'store'])->name('admin.lapangan.store');
        Route::put('/lapangan/{id}', [AdminLapanganController::class, 'update'])->name('admin.lapangan.update');
        Route::delete('/lapangan/{id}', [AdminLapanganController::class, 'destroy'])->name('admin.lapangan.destroy');

        // Payments Review
        Route::get('/payments', [AdminPaymentController::class, 'index'])->name('admin.payments.index');
        Route::post('/payments/{id}/approve', [AdminPaymentController::class, 'approve'])->name('admin.payments.approve');
        Route::post('/payments/{id}/reject', [AdminPaymentController::class, 'reject'])->name('admin.payments.reject');

        // Revenue Reports
        Route::get('/revenue', [AdminDashboardController::class, 'revenue'])->name('admin.revenue');

        // Profile details
        Route::get('/profile', [AdminProfileController::class, 'show'])->name('admin.profile');
        Route::post('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    });
});
