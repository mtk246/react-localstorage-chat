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
        Schema::create('claim_eligibility_benefits_information', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->string('name', 50);
            $table->string('service_type_codes')->nullable();
            $table->string('service_types')->nullable();
            $table->string('insurance_type_code')->nullable();
            $table->string('insurance_type')->nullable();
            $table->string('time_qualifer_code')->nullable();
            $table->string('time_qualifer')->nullable();
            $table->string('benefit_amount')->nullable();
            $table->string('benefits_date_information')->nullable();
            $table->string('additional_information')->nullable();
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
        Schema::dropIfExists('claim_eligibility_benefits_information');
    }
};
