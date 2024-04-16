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
        Schema::table('workflows', function (Blueprint $table) {
            $table->integer('sort_id')->after('workflow_step_id')->nullable();
            $table->enum('is_rejectable', ['yes', 'no'])->after('sort_id')->nullable();
            $table->foreignId('reject_workflow_step_id')->after('is_rejectable')->nullable()->constrained('workflow_steps');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workflows', function (Blueprint $table) {
            $table->dropColumn('sort_id');
            $table->dropColumn('is_rejectable');
            $table->dropColumn('reject_workflow_step_id');
        });
    }
};
