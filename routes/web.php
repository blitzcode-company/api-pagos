<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagoStripeController;

Route::group(['prefix' => 'stripe', 'as' => 'stripe.'], function () {
    Route::get('/', [PagoStripeController::class, 'formularioDePago'])->name('form');
    Route::post('/', [PagoStripeController::class, 'procesarPago'])->name('process');
});
