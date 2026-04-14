<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\DahboardController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\ReservationController;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Route::get('services', [ServiceController::class, 'index'])->name('services.index');
Route::get('aboutus', function () {
    return view('Home.about');
})->name('about');
Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'sendmail'])
    ->name('contact.store');

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('login', [AuthController::class, 'Showlogin'])->name('Showlogin');




Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('register', [AuthController::class, 'ShowRegister'])->name('Showregister');






Route::middleware(['auth', 'client'])->prefix('client')->group(function () {
    Route::get('reservations/{room}', [ReservationController::class, 'formReserv'])->name('ShowReservation');
    Route::get('reservations/{reservation}/show', [ReservationController::class, 'show'])->name('detailReservation');
    Route::delete('reservations/{reservation}', [ClientController::class, 'cancel'])
        ->name('client.reservation.cancel');

    Route::get('invoice/{reservation}', [FactureController::class, 'print'])
        ->name('invoice.print');
    Route::post('rooms/{room}/reserve', [ReservationController::class, 'reserver'])->name('reservations.store');
    Route::get('/change-password', [AuthController::class, 'changePasswordForm'])->name('password.change.form');
    Route::post('/change-password', [AuthController::class, 'changePassword'])
        ->name('password.change');
    Route::get('client/dashboard', [ClientController::class, 'dashboard'])
        ->name('client.dashboard');

    Route::get('reservations', [ClientController::class, 'reservations'])
        ->name('client.reservations');
    Route::post('reservations/{reservation}', [ReservationController::class, 'refuseOrAnnuler'])->name('refuseOrAnnuleer');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
});
Route::get('/rooms', [RoomController::class, 'index'])->name('Room.index');




Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('receptionists', ReceptionistController::class);
    });
// Route::get('dashboard', [DahboardController::class, 'index'])->name('receptionnist.dashboard');
Route::middleware(['auth', 'role:admin,Receptionniste'])
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {

        /*

         Statistiques

        */
        Route::get('statistique', [DahboardController::class, 'index'])
            ->name('statistique');

        Route::get('rooms-dashboard', [DahboardController::class, 'dashboard_room'])
            ->name('rooms');


        /*
         Reservations
        */
        Route::prefix('reservations')->name('reservations.')->group(function () {

            Route::get('/', [ReservationController::class, 'index'])->name('index');
            Route::get('create', [ReservationController::class, 'create'])->name('create');
            Route::post('/', [ReservationController::class, 'store'])->name('store');

            Route::patch(
                '{reservation}/accept',
                [ReservationController::class, 'accept']
            )->name('accept');

            Route::post(
                '{reservation}',
                [ReservationController::class, 'refuseOrAnnuler']
            )->name('refuseOrAnnuleer');
        });


        /*
        Rooms
        */
        Route::prefix('rooms')->name('rooms.')->group(function () {
            Route::get('create', [RoomController::class, 'create'])->name('create');
            Route::post('/', [RoomController::class, 'store'])->name('store');
            Route::get('{room}/edit', [RoomController::class, 'edit'])->name('edit');
            Route::put('{room}', [RoomController::class, 'update'])->name('update');
            Route::delete('{room}', [RoomController::class, 'destroy'])->name('destroy');
        });


        /*

         Clients

        */
        Route::prefix('clients')->name('clients.')->group(function () {

            Route::get('/', [ClientController::class, 'index'])->name('index');
            Route::get('create', [ClientController::class, 'create'])->name('create');
            Route::post('/', [ClientController::class, 'store'])->name('store');
            Route::get('{client}', [ClientController::class, 'show'])->name('show');

            Route::post(
                '{client}/ban',
                [ClientController::class, 'banOrdeban']
            )->name('banordeban');
        });


        /*

         Payments

        */
        Route::prefix('payments')->name('payments.')->group(function () {

            Route::patch(
                '{payment}/pay',
                [PaymentsController::class, 'pay']
            )->name('pay');
        });
    });
