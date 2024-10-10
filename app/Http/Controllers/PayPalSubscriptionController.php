<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PayPalSubscriptionController extends Controller
{
    public function cancelarSuscripcion(Request $request)
    {
        $subscriptionId = $request->input('subscription_id');

        if (!$subscriptionId) {
            return response()->json([
                'success' => false,
                'message' => 'El ID de la suscripción es requerido.',
            ], 400);
        }

        try {
            $accessToken = $this->getPayPalAccessToken();
            $client = new Client();
            $response = $client->post("https://api.sandbox.paypal.com/v1/billing/subscriptions/{$subscriptionId}/cancel", [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'reason' => 'Cancelado por el cliente',
                ],
            ]);
            if ($response->getStatusCode() == 204) {
                return response()->json([
                    'success' => true,
                    'message' => 'Suscripción cancelada con éxito.',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudo cancelar la suscripción.',
                ], $response->getStatusCode());
            }

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cancelar la suscripción: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function getPayPalAccessToken()
    {
        try {
            $client = new Client();

            $response = $client->post('https://api.sandbox.paypal.com/v1/oauth2/token', [
                'auth' => [env('PAYPAL_CLIENT_ID'), env('PAYPAL_SECRET')],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);

            $data = json_decode($response->getBody());

            return $data->access_token;

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw new \Exception('Error obteniendo token de acceso de PayPal: ' . $e->getMessage());
        }
    }
}
