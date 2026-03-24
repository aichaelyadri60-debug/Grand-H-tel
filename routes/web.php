<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('home');
})->name('homepage');
