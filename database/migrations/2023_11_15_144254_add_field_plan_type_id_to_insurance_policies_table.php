<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('insurance_policies', function (Blueprint $table) {
            $table->foreignId('plan_type_id')
                ->nullable()
                ->constrained('type_catalogs')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });

        DB::statement('UPDATE insurance_policies
            SET plan_type_id = (
                SELECT ipt.plan_type_id
                FROM insurance_plan_plan_type AS ipt
                JOIN insurance_policies AS ip ON ip.insurance_plan_id = ipt.insurance_plan_id
                WHERE ip.billing_company_id = ipt.billing_company_id
                    AND ip.insurance_plan_id = insurance_policies.insurance_plan_id
                ORDER BY ipt.id DESC
                LIMIT 1
            )
            WHERE EXISTS (
                SELECT 1
                FROM insurance_plan_plan_type AS ipt
                JOIN insurance_policies AS ip ON ip.insurance_plan_id = ipt.insurance_plan_id
                WHERE ip.billing_company_id = ipt.billing_company_id
                    AND ip.insurance_plan_id = insurance_policies.insurance_plan_id
            )');
    }

    public function down(): void
    {
        Schema::table('insurance_policies', function (Blueprint $table) {
            $table->dropForeign(['plan_type_id']);
            $table->dropColumn('plan_type_id');
        });
    }
};
