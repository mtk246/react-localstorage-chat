<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('medications', function (Blueprint $table) {
            $table->dropForeign(['company_procedure_id']);
            $table->dropColumn(['date', 'batch', 'quantity', 'frequency', 'company_procedure_id']);
            $table->string('drug_code', 10)->change();
            $table->unsignedBigInteger('measurement_unit_id')->nullable();
            $table->unsignedDecimal('units')->nullable();
            $table->unsignedDecimal('units_limit')->nullable();
            $table->unsignedDecimal('link_sequence_number')->nullable();
            $table->unsignedDecimal('pharmacy_prescription_number')->nullable();
            $table->boolean('repackaged_NDC')->default(false);
            $table->string('code_NDC', 10)->nullable();
            $table->string('note')->nullable();
            $table->foreignId('company_service_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('medications', function (Blueprint $table) {
            $table->dropColumn(
                [
                    'measurement_unit_id',
                    'units',
                    'units_limit',
                    'link_sequence_number',
                    'pharmacy_prescription_number',
                    'repackaged_NDC',
                    'code_NDC',
                    'note',
                ]
            );
            $table->date('date')->nullable()->after('name');
            $table->string('batch')->nullable()->after('date');
            $table->string('quantity')->nullable()->after('batch');
            $table->string('frequency')->nullable()->after('quantity');
            $table->string('drug_code')->change();
        });
    }
};
