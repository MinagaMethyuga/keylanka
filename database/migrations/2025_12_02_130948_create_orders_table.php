<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();

            // Customer Information
            $table->string('First_Name')->nullable();
            $table->string('Last_Name')->nullable();
            $table->string('Email')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Address')->nullable();
            $table->string('City')->nullable();
            $table->string('State')->nullable();
            $table->string('Zip_Code')->nullable();
            $table->text('Delivery_Instructions')->nullable();

            // Payment Status
            $table->integer('status')->default(0);
            // 0=pending, 1=processing, 2=completed, -1=cancelled, -2=failed

            // Progress Tracking
            $table->string('progress_status')->default('pending');
            // pending, prepping, accepted, out_for_delivery, completed, cancelled

            $table->json('progress_timeline')->nullable();
            // Stores history of all status changes with timestamps

            // Payment Information
            $table->string('payment_id')->nullable();
            $table->decimal('paid_amount', 10, 2)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('currency', 5)->default('LKR');

            // Order Items (JSON)
            $table->json('items')->nullable();
            // Stores array of products with id, title, price, quantity, image

            // Optional Card Information
            $table->string('card_holder_name')->nullable();
            $table->string('card_no')->nullable();
            $table->string('card_expiry')->nullable();

            $table->timestamps();

            // Indexes for better query performance
            $table->index('order_id');
            $table->index('Email');
            $table->index('progress_status');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
