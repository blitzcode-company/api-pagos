<?php

use App\Http\Controllers\PagoStripeController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth.api')->group(function () {
    Route::group(['prefix' => 'stripe'], function () {
        Route::post('/procesar-pago', [PagoStripeController::class, 'procesarPago']);
        Route::post('/cancelar-suscripcion', [PagoStripeController::class, 'cancelarSuscripcion']);
    });
});
