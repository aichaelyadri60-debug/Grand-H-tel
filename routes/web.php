<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;


Route::get('/', function () {
    return view('home');
})->name('homepage');
Route::get('/rooms/create', [RoomController::class, 'create'])->name('createRoom');
Route::get('/rooms', [RoomController::class, 'index'])->name('Room.index');
Route::post('/rooms', [RoomController::class, 'store'])->name('storeRoom');
Route::get('rooms/{room}/edit', [RoomController::class, 'edit'])->name('editRoom');
Route::put('rooms/{room}', [RoomController::class, 'update'])->name('updateRoom');
Route::delete('rooms/{room}', [RoomController::class, 'destroy'])->name('destroyRoom');

Route::get('services', [ServiceController::class, 'index'])->name('services.index');
Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'sendmail'])
    ->name('contact.store');

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('login', [AuthController::class, 'Showlogin'])->name('Showlogin');

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('register', [AuthController::class, 'ShowRegister'])->name('Showregister');
