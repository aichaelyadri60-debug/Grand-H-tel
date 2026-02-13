<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('createRoom' ,[RoomController::class ,'create'])->name('createRoom');
Route::post('storeRoom' ,[RoomController::class ,'store'])->name('storeRoom');
