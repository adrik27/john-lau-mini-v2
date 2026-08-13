<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('message_id')->nullable()->index();
            $table->string('space_id')->nullable();
            $table->string('thread_id')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('sender_email')->nullable();
            $table->text('raw_text')->nullable();
            $table->text('attachment_url')->nullable();
            $table->string('drive_file_id')->nullable();
            $table->text('drive_web_view_link')->nullable();
            $table->string('item_name')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('category')->nullable();
            $table->string('status')->default('pending_confirmation');
            $table->timestamp('confirmed_at')->nullable();
            $table->boolean('sheets_synced')->default(false);
            $table->timestamp('sheets_synced_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
