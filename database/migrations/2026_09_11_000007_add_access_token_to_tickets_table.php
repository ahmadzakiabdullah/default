<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table): void {
            $table->string('access_token_hash')->nullable()->after('tracking_id');
            $table->dateTime('access_token_expires_at')->nullable()->after('access_token_hash');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table): void {
            $table->dropColumn(['access_token_hash', 'access_token_expires_at']);
        });
    }
};
