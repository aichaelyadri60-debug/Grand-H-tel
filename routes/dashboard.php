<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\DahboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ClientController;


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
