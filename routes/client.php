<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AuthController;




Route::middleware(['auth', 'role:client'])->prefix('client')->group(function () {
    Route::get('reservations/{room}', [ReservationController::class, 'formReserv'])->name('ShowReservation');
    Route::get('reservations/{reservation}/show', [ReservationController::class, 'show'])->name('detailReservation');
    Route::delete('reservations/{reservation}', [ClientController::class, 'cancel'])
        ->name('client.reservation.cancel');
    Route::get('dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');

    Route::get('invoice/{reservation}', [FactureController::class, 'print'])
        ->name('invoice.print');
    Route::post('rooms/{room}/reserve', [ReservationController::class, 'reserver'])->name('reservations.store');
    Route::get('/change-password', [AuthController::class, 'changePasswordForm'])->name('password.change.form');
    Route::post('/change-password', [AuthController::class, 'changePassword'])
        ->name('password.change');

    Route::get('reservations', [ClientController::class, 'reservations'])
        ->name('client.reservations');
    Route::post('reservations/{reservation}', [ReservationController::class, 'refuseOrAnnuler'])->name('refuseOrAnnuleer');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
});
