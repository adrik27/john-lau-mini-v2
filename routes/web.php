<?php

use App\Http\Controllers\GoogleChatWebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/google-chat/webhook', [GoogleChatWebhookController::class, 'handle']);
