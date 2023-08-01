<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('contract_fee_specifications', function (Blueprint $table) {
            $table->dropForeign(['billing_provider_id']);
            $table->dropColumn(['billing_provider_id']);
        });
        Schema::table('contract_fee_specifications', function (Blueprint $table) {
            $table->nullableMorphs('billing_provider');
            $table->string('billing_provider_tax_id', 20)->nullable();
            $table->string('health_professional_tax_id', 20)->nullable();
            $table->bigInteger('billing_provider_taxonomy_id')->nullable()->change();
            $table->bigInteger('health_professional_id')->nullable()->change();
            $table->bigInteger('health_professional_taxonomy_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('contract_fee_specifications', function (Blueprint $table) {
            $table->dropColumn(
                [
                    'billing_provider_id',
                    'billing_provider_type',
                    'billing_provider_tax_id',
                    'health_professional_tax_id',
                ]
            );
        });
        Schema::table('contract_fee_specifications', function (Blueprint $table) {
            $table->bigInteger('billing_provider_taxonomy_id')->change();
            $table->bigInteger('health_professional_id')->change();
            $table->bigInteger('health_professional_taxonomy_id')->change();
            $table->foreignId('billing_provider_id')
                ->nullable()
                ->constrained('health_professionals')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }
};
