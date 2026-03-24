<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;


Route::get('/', function () {
    return view('home');
})->name('homepage');
Route::get('/rooms/create' ,[RoomController::class ,'create'])->name('createRoom');
Route::get('/rooms', [RoomController::class, 'index'])->name('Room.index');
Route::post('/rooms' ,[RoomController::class ,'store'])->name('storeRoom');
Route::get('rooms/{room}/edit' ,[RoomController::class ,'edit'])->name('editRoom');
Route::put('rooms/{room}' ,[RoomController::class ,'update'])->name('updateRoom');
Route::delete('rooms/{room}' ,[RoomController::class ,'destroy'])->name('destroyRoom');

Route::get('services' ,[ServiceController::class ,'index'])->name('services.index');
