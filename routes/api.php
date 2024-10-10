<?php

use App\Http\Controllers\PagoStripeController;
use App\Http\Controllers\PayPalSubscriptionController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth.api')->group(function () {
    Route::group(['prefix' => 'stripe'], function () {
        Route::post('/procesar-pago', [PagoStripeController::class, 'procesarPago']);
        Route::post('/cancelar-suscripcion', [PagoStripeController::class, 'cancelarSuscripcion']);
    });

    Route::group(['prefix' => 'paypal'], function () {
        Route::post('/cancel-subscription', [PayPalSubscriptionController::class, 'cancelarSuscripcion']);

    });

});