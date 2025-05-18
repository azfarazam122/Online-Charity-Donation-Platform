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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title');
            $table->text('description');
            $table->decimal('goal_amount', 10, 2); // e.g., up to 99,999,999.99
            $table->decimal('current_amount', 10, 2)->default(0.00);
            $table->string('image_path')->nullable(); // Path to an uploaded image
            $table->string('status')->default('active'); // e.g., active, completed, closed
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
