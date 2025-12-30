<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('otp_verifications', function (Blueprint $table) {
            $table->id();

            // FK must match users.id type
            $table->unsignedBigInteger('user_id');

            $table->string('otp_code', 6);
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->boolean('verified')->default(false);
            $table->integer('attempts')->default(0);

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('otp_verifications');
    }
};
