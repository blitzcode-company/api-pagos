<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PagoStripeController extends Controller
{
    public function formularioDePago()
    {
        return view('formularioDePago');
    }

    public function procesarPago(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $charge = Charge::create([
                'amount' => 1000,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Pago por suscripción al plan Premium de Blitzvideo.',
            ]);

            return back()->with('success', '¡Pago realizado con éxito! Gracias por unirte al plan Premium de Blitzvideo.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
