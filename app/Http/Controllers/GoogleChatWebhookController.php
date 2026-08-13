<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessExpenseMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GoogleChatWebhookController extends Controller
{
    /**
     * Handle incoming webhook requests from Google Chat.
     */
    public function handle(Request $request): JsonResponse
    {
        $payload = $request->all();

        Log::info('Google Chat Webhook received.', ['payload' => $payload]);

        // Masukkan pesan ke antrean (Laravel Queue) untuk diproses secara asinkron
        ProcessExpenseMessage::dispatch($payload);

        // Respons instan 200 OK ke Google Chat agar tidak timeout (0 timeout)
        return response()->json([
            'text' => '⏳ Laporan pengeluaran Anda telah diterima dan sedang diproses...',
        ]);
    }
}
