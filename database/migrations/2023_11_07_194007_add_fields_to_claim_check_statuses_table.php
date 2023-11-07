<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('claim_check_statuses', function (Blueprint $table) {
            $table->date('follow_up_date')->nullable();
            $table->unsignedSmallInteger('department_responsibility_id')->nullable();
            $table->foreignId('insurance_policy_id')
                ->nullable()
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('claim_check_statuses', function (Blueprint $table) {
            $table->dropForeign(['insurance_policy_id']);
            $table->dropColumn(['follow_up_date', 'department_responsibility_id', 'insurance_policy_id']);
        });
    }
};
