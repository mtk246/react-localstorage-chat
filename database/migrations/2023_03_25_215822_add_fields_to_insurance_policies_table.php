<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('insurance_policies', function (Blueprint $table) {
            $table->foreignId('billing_company_id')
                ->nullable()
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreignId('patient_id')
                ->nullable()
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->boolean('status')->default(true);
            $table->boolean('own')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('insurance_policies', function (Blueprint $table) {
            $table->dropForeign(['billing_company_id']);
            $table->dropColumn('billing_company_id');
            $table->dropForeign(['patient_id']);
            $table->dropColumn('patient_id');
            $table->dropColumn('status');
            $table->dropColumn('own');
        });
    }
};
