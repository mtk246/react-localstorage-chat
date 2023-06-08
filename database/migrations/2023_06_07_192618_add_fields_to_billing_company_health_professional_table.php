<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('billing_company_health_professional', function (Blueprint $table) {
            $table->string('npi_company')->nullable();
            $table->boolean('is_provider')->default(false);
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('health_professional_type_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('billing_company_health_professional', function (Blueprint $table) {
            $table->dropForeign(['health_professional_type_id', 'company_id']);
            $table->dropColumn(['npi_company', 'is_provider', 'health_professional_type_id', 'company_id']);
        });
    }
};
