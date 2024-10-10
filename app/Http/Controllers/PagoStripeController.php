<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Customer;
use Stripe\Stripe;
use Stripe\Subscription;

class PagoStripeController extends Controller
{
    public function procesarPago(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $email = $request->input('email');
            $nombre = $request->input('nombre');
            $direccion = $request->input('direccion');
            $stripeToken = $request->stripeToken;

            $existingCustomers = Customer::all(['email' => $email]);
            if (count($existingCustomers->data) > 0) {
                $customer = $existingCustomers->data[0];
            } else {
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
                    'source' => $stripeToken,
                ]);
            }
            $subscription = Subscription::create([
                'customer' => $customer->id,
                'items' => [
                    [
                        'price' => env('STRIPE_PRICE_ID'),
                    ],
                ],
            ]);

            return response()->json([
                'success' => true,
                'message' => '¡Suscripción creada con éxito! Gracias por unirte al plan Premium de Blitzvideo.',
                'subscription' => $subscription,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la suscripción: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function cancelarSuscripcion(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $email = $request->input('email');
            $existingCustomers = Customer::all(['email' => $email]);

            if (count($existingCustomers->data) > 0) {
                $customer = $existingCustomers->data[0];
                $subscriptions = Subscription::all(['customer' => $customer->id, 'status' => 'active']);

                if (count($subscriptions->data) > 0) {
                    $subscription = $subscriptions->data[0];
                    $subscription->cancel();

                    return response()->json([
                        'success' => true,
                        'message' => 'Suscripción cancelada con éxito.',
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'No se encontró ninguna suscripción activa para cancelar.',
                    ], 404);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Cliente no encontrado.',
                ], 404);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cancelar la suscripción: ' . $e->getMessage(),
            ], 500);
        }
    }
}
