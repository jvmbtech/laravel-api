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
            $table->id();
            $table->string('name', length: 255);
            $table->string('email', length: 255)->unique();
            $table->string('password', length: 255);
            $table->string('cpf', length: 16);
            $table->string('phone', length: 20);
            $table->string('cellphone', length: 20);
            $table->string('role', length: 32);
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
