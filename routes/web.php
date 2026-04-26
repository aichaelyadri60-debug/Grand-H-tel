<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;



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
Route::get('/rooms', [RoomController::class, 'index'])->name('Room.index');



require __DIR__.'/auth.php';
require __DIR__.'/client.php';
require __DIR__.'/admin.php';
require __DIR__.'/dashboard.php';
