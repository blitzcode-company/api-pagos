<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class PagoStripeController extends Controller
{
    public function procesarPago(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $email = $request->input('email');
            $nombre = $request->input('nombre');
            $direccion = $request->input('direccion');
            $customer = Customer::create([
                'email' => $email,
                'name' => $nombre,
                'address' => [
                    'line1' => $direccion['line1'],
                    'city' => $direccion['city'],
                    'state' => $direccion['state'],
                    'postal_code' => $direccion['postal_code'],
                    'country' => $direccion['country'],
                ],
                'source' => $request->stripeToken,
            ]);
            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => 1000,
                'currency' => 'usd',
                'description' => 'Pago por suscripción al plan Premium de Blitzvideo.',
            ]);

            return response()->json([
                'success' => true,
                'message' => '¡Pago realizado con éxito! Gracias por unirte al plan Premium de Blitzvideo.',
                'charge' => $charge,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar el pago: ' . $e->getMessage(),
            ], 500);
        }
    }
}
