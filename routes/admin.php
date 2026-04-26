<?php

use App\Http\Controllers\ReceptionistController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('receptionists', ReceptionistController::class);
    });
