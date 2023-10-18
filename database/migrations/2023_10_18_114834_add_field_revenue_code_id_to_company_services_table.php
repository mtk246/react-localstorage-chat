<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('company_services', function (Blueprint $table) {
            $table->foreignId('procedure_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('modifier_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('revenue_code_id')
                ->nullable()
                ->constrained('procedures')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        DB::statement('UPDATE company_services
              SET procedure_id = (SELECT procedure_id FROM company_service_procedure WHERE company_services.id = company_service_procedure.company_service_id LIMIT 1)');

        DB::statement('UPDATE company_services
            SET modifier_id = (SELECT modifier_id FROM company_service_modifier WHERE company_services.id = company_service_modifier.company_service_id LIMIT 1)');
    }

    public function down(): void
    {
        Schema::table('company_services', function (Blueprint $table) {
            $table->dropForeign(['procedure_id']);
            $table->dropForeign(['modifier_id']);
            $table->dropForeign(['revenue_code_id']);
            $table->dropColumn(['procedure_id', 'modifier_id', 'revenue_code_id']);
        });
    }
};
