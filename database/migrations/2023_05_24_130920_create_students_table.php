<?php
use App\Enums\AccountStatus;
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
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('guardian_id')->constrained()->cascadeOnDelete();
            $table->string('account_number');
            $table->string('name');
            $table->string('Date_of_birth');
            $table->string('school_name');
            $table->string('county');
            $table->tinyInteger('account_status')->default(AccountStatus::INACTIVE);
            $table->string('username');
            $table->string('pin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
