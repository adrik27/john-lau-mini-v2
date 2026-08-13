<?php

namespace App\Services;

use Google\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleChatService
{
    /**
     * Mendapatkan token akses menggunakan Service Account JSON
     */
    private function getAccessToken(): ?string
    {
        try {
            $credentialsPath = env('GOOGLE_CREDENTIALS_PATH', 'storage/app/google-service-account.json');
            $fullPath = base_path($credentialsPath);

            if (!file_exists($fullPath)) {
                Log::error("File Service Account tidak ditemukan di path: {$fullPath}");
                return null;
            }

            $client = new Client();
            // Arahkan ke file JSON Service Account
            $client->setAuthConfig($fullPath);
            // Minta izin khusus untuk mengirim pesan sebagai Bot
            $client->addScope('https://www.googleapis.com/auth/chat.bot');
            
            $client->fetchAccessTokenWithAssertion();
            $token = $client->getAccessToken();
            
            return $token['access_token'] ?? null;
        } catch (\Exception $e) {
            Log::error('Gagal mendapatkan token Google Chat: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Mengirim pesan asinkron ke space & thread tertentu di Google Chat
     */
    public function sendMessage(string $spaceName, string $threadName, string $text): bool
    {
        $token = $this->getAccessToken();
        if (!$token) {
            return false;
        }

        // Endpoint REST API Google Chat (V1)
        $url = "https://chat.googleapis.com/v1/{$spaceName}/messages";

        $response = Http::withToken($token)->post($url, [
            'text'   => $text,
            'thread' => ['name' => $threadName]
        ]);

        if ($response->failed()) {
            Log::error('Gagal mengirim pesan ke Chat API: ' . $response->body());
            return false;
        }

        return true;
    }
}
