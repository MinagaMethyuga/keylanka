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
        Schema::create('users', function (Blueprint $table) {
            // Primary Key: Standard 'id' for Eloquent/Auth functionality
            $table->id();

            // User basic credentials
            $table->string('name');

            $table->string('email')->unique();

            $table->string('email_code')->nullable();
            $table->boolean('verified')->default(false);
            $table->timestamp('email_verified_at')->nullable();

            $table->string('role')->nullable();

            $table->string('password')->nullable();

            // Standard Laravel field for 'Remember Me' functionality
            $table->rememberToken();

            // Timestamps: 'created_at' and 'updated_at'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
