<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_service_lines', function (Blueprint $table) {
            $table->id();
            $table->string('assigned_number');
            $table->string('claim_filing_code', 2);
            $table->date('service_date');
            $table->string('provider_control_number', 50);
            $table->string('procedure_identifier', 2);
            $table->string('procedure_code', 48);
            $table->string('procedure_modifiers', 2);
            $table->string('description', 80);
            $table->string('line_item_charge_amount', 18);
            $table->string('measurement_unit', 2);
            $table->string('service_unit_count', 8);
            $table->string('diagnosis_code_pointers', 2);

            $table->foreignId('claim_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('place_of_service_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claim_service_lines');
    }
};
