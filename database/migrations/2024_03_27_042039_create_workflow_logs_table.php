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
        Schema::create('workflow_logs', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('transaction_id',10)->nullable()->constrained('transactions');
            $table->foreignId('service_id',10)->nullable()->constrained('services');
            $table->foreignId('workflow_id',10)->nullable()->constrained('workflows');
            $table->foreignId('user_id',10)->nullable()->constrained('users');
            $table->foreignId('role_id',10)->nullable()->constrained('roles');
            $table->string('status',191)->nullable();
            $table->timestamp('claimed_time')->nullable();
            $table->timestamp('approved_time')->nullable();
            $table->timestamp('rejected_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workflow_logs');
    }
};
