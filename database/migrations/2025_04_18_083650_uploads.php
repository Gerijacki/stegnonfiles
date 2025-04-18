<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('original_filename')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('path');
            $table->binary('encryption_key');
            $table->binary('user_password_salt')->nullable();
            $table->binary('iv_base_encryption')->nullable();
            $table->binary('iv_user_password')->nullable();
            $table->boolean('has_password')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
