<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table): void {
            $table->id();
            $table->string('tracking_id')->unique();
            $table->string('guest_name');
            $table->string('guest_email')->index();
            $table->string('guest_phone');
            $table->text('guest_address')->nullable();
            $table->foreignId('department_id')->constrained()->restrictOnDelete();
            $table->string('priority')->default('sederhana');
            $table->string('subject');
            $table->text('message');
            $table->string('status')->default('baru');
            $table->foreignId('assigned_to_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('resolved_at')->nullable();
            $table->dateTime('first_responded_at')->nullable();
            $table->dateTime('due_at')->nullable();
            $table->dateTime('closed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
