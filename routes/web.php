<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/rooms/create' ,[RoomController::class ,'create'])->name('createRoom');
Route::post('/rooms' ,[RoomController::class ,'store'])->name('storeRoom');
Route::get('rooms/{room}/edit' ,[RoomController::class ,'edit'])->name('editRoom');
Route::put('rooms/{room}' ,[RoomController::class ,'update'])->name('updateRoom');

