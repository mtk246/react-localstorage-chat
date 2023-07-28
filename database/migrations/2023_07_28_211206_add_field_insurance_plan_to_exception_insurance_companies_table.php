<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('exception_insurance_companies', function (Blueprint $table) {
            $table->dropForeign(['insurance_company_id']);
            $table->dropColumn('insurance_company_id');
            $table->json('insurance_plan_ids')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('exception_insurance_companies', function (Blueprint $table) {
            $table->dropColumn('insurance_plan_ids');
            $table->foreignId('insurance_company_id')
                ->nullable()
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }
};
