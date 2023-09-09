<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('claim_rules', function (Blueprint $table) {
            $table->dropForeign(['insurance_company_id']);
            $table->dropColumn('insurance_company_id');
            $table->foreignId('insurance_plan_id')
                ->nullable()
                ->constrained('insurance_plans')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('claim_rules', function (Blueprint $table) {
            $table->dropForeign(['insurance_plan_id']);
            $table->dropColumn('insurance_plan_id');
            $table->foreignId('insurance_company_id')
                ->nullable()
                ->constrained('insurance_companies')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }
};
