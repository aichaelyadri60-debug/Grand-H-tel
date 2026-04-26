<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('login', [AuthController::class, 'Showlogin'])->name('Showlogin');

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('register', [AuthController::class, 'ShowRegister'])->name('Showregister');
