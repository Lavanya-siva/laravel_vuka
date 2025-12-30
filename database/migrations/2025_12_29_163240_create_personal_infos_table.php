<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // FK

            $table->enum('proof_type', [
                'National ID',
                'Alien ID',
                'Passport ID'
            ]);

            $table->string('id_number')->unique();
            $table->string('kra_pin')->unique();
            $table->date('date_of_birth');
            $table->string('nationality');
            $table->string('country_residence');
            $table->string('country_birth');
            $table->enum('gender', ['Male', 'Female', 'Others']);
            $table->enum('employment_status', [
                'Employed',
                'Unemployed',
                'SelfEmployed'
            ]);
            $table->enum('status', ['incomplete', 'completed'])
                  ->default('incomplete');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_infos');
    }
};
