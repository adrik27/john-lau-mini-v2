<?php

namespace App\Jobs;

use App\Models\Expense;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessExpenseMessage implements ShouldQueue
{
    use Queueable;

    public array $payload;

    /**
     * Create a new job instance.
     *
     * @param array $payload Payload event dari Google Chat Webhook
     */
    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('ProcessExpenseMessage started.', ['payload' => $this->payload]);

        $message = $this->payload['message'] ?? [];
        $space = $this->payload['space'] ?? [];
        $sender = $message['sender'] ?? [];
        $thread = $message['thread'] ?? [];

        $messageId = $message['name'] ?? null;
        $rawText = $message['text'] ?? null;
        $senderName = $sender['displayName'] ?? null;
        $senderEmail = $sender['email'] ?? null;
        $spaceId = $space['name'] ?? null;
        $threadId = $thread['name'] ?? null;

        // Ambil attachment info jika ada
        $attachmentUrl = null;
        if (!empty($message['attachment'])) {
            $attachments = $message['attachment'];
            $attachmentUrl = $attachments[0]['contentUrl'] ?? ($attachments[0]['downloadUri'] ?? json_encode($attachments));
        }

        // Simpan / update ke database expenses sebagai bukti event masuk
        $expense = Expense::create([
            'message_id'     => $messageId,
            'space_id'       => $spaceId,
            'thread_id'      => $threadId,
            'sender_name'    => $senderName,
            'sender_email'   => $senderEmail,
            'raw_text'       => $rawText,
            'attachment_url' => $attachmentUrl,
            'status'         => 'pending_confirmation',
        ]);

        Log::info('Expense record created asynchronously.', [
            'expense_id' => $expense->id,
            'sender'     => $senderName,
            'text'       => $rawText,
        ]);

        // Kirim pesan balasan asinkron via Google Chat REST API
        if ($spaceId && $threadId) {
            $chatService = app(\App\Services\GoogleChatService::class);
            $chatService->sendMessage(
                $spaceId,
                $threadId,
                "✅ Laporan pengeluaran dari {$senderName} telah dicatat ke antrean."
            );
        }

        // TODO Phase 2: Unduh attachment ke Google Drive & Ekstraksi AI via Gemini
        // TODO Phase 3: Kirim Interactive Confirmation Card (Card V2) balik ke Google Chat
    }
}
