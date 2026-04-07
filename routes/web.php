<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ReceptionnistController;
use App\Http\Controllers\ReservationController;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;

Route::get('/', function () {
    return view('home');
})->name('homepage');

Route::get('services', [ServiceController::class, 'index'])->name('services.index');
Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'sendmail'])
    ->name('contact.store');

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('login', [AuthController::class, 'Showlogin'])->name('Showlogin');




Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('register', [AuthController::class, 'ShowRegister'])->name('Showregister');






Route::middleware(['auth', 'client'])->group(function () {
    Route::get('Reservation/{room}', [ReservationController::class, 'formReserv'])->name('ShowReservation');
    Route::post('/rooms/{room}/reserve', [ReservationController::class, 'reserver'])->name('reservations.store');
});




Route::middleware(['auth', 'role:admin,Receptionniste'])->group(function () {
    Route::patch('reservations/{reservation}/accept', [ReservationController::class, 'accept'])->name('reservations.accept');
    Route::get('reservations', [ReservationController::class, 'index'])->name('Reservations.index');
    Route::delete('reservations/{reservation}', [ReservationController::class, 'destroy'])->name('Reservations.destroy');
    Route::get('dashboard', [ReceptionnistController::class, 'index'])->name('receptionnist.dashboard');
    Route::get('dashboard/room', [ReceptionnistController::class, 'dashboard'])->name('receptionnist.dashboard.room');
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('createRoom');
    Route::get('/rooms', [RoomController::class, 'index'])->name('Room.index');
    Route::post('/rooms', [RoomController::class, 'store'])->name('storeRoom');
    Route::get('rooms/{room}/edit', [RoomController::class, 'edit'])->name('editRoom');
    Route::put('rooms/{room}', [RoomController::class, 'update'])->name('updateRoom');
    Route::delete('rooms/{room}', [RoomController::class, 'destroy'])->name('destroyRoom');

    Route::get('clients', [ClientController::class,'index'])
    ->name('clients.index');
    Route::post('clients/{client}', [ClientController::class,'banOrdeban'])
    ->name('clients.banordeban');
    Route::get('clients/create', [ClientController::class,'create'])
    ->name('Client.create');


    Route::patch('payment/{payment}/pay', [PaymentsController::class, 'pay'])->name('payments.pay');
});
