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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Nullable for guest donations
            $table->decimal('amount', 10, 2);
            $table->string('stripe_checkout_session_id')->unique();
            $table->string('status')->default('succeeded'); // Default for successful redirect
            $table->string('donor_name')->nullable(); // Could be captured from Stripe if not logged in
            $table->string('donor_email')->nullable(); // Could be captured from Stripe if not logged in
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
