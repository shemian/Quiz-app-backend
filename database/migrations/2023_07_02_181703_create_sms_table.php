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
        Schema::create('sms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('external_ref')->unique();
            $table->string('recipient');
            $table->string('text');
            $table->string('short_code')->default('Centy Plus');
            $table->string('pass_type')->default(0);
            $table->string('delivery_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms');
    }
};
