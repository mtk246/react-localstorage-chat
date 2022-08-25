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
        Schema::create('claim_eligibility_trace_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('trace_type_code', 50);
            $table->string('trace_type', 50);
            $table->string('reference_identification', 50);
            $table->string('originating_company_identifier', 50);
            $table->foreignId('claim_eligibility_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('claim_eligibility_trace_numbers');
    }
};