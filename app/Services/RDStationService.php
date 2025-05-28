<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RDStationService
{
    protected $clientId;
    protected $clientSecret;
    protected $accessToken;
    protected $refreshToken;

    public function __construct()
    {
        $this->clientId = config('services.rdstation.client_id');
        $this->clientSecret = config('services.rdstation.client_secret');
        $this->accessToken = config('services.rdstation.access_token');
        $this->refreshToken = config('services.rdstation.refresh_token');
    }

    public function createOpportunity(array $payload)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->getValidToken(),
                'Content-Type' => 'application/json'
            ])->post('https://api.rd.services/platform/opportunities', $payload);

            if ($response->failed()) {
                Log::error('Erro RD Station: ' . $response->body(), [
                    'payload' => $payload,
                    'status' => $response->status()
                ]);
                return [
                    'success' => false,
                    'message' => 'Falha ao enviar para RD Station',
                    'details' => $response->json()
                ];
            }

            return [
                'success' => true,
                'data' => $response->json()
            ];

        } catch (\Throwable $e) {
            Log::error('Exception RD Station: ' . $e->getMessage(), [
                'payload' => $payload,
                'exception' => $e
            ]);
            return [
                'success' => false,
                'message' => 'Erro inesperado ao integrar com RD Station',
                'details' => $e->getMessage()
            ];
        }
    }

    protected function getValidToken()
    {
        // Implementar lógica de refresh token se necessário
        return $this->accessToken;
    }

    protected function refreshAccessToken()
    {
        $response = Http::post('https://api.rd.services/auth/token', [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'refresh_token' => $this->refreshToken,
            'grant_type' => 'refresh_token'
        ]);

        if ($response->successful()) {
            $tokens = $response->json();
            // Atualizar tokens no banco/arquivo de configuração
            return $tokens['access_token'];
        }

        throw new \Exception('Falha ao atualizar token RD Station');
    }
}
