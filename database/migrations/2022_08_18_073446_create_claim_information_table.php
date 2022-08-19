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
        Schema::create('claim_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('claim_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('patient_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->string('claim_filing_code', 2);
            $table->string('claim_number', 50);
            $table->string('patient_weight', 10);
            $table->string('patient_control_number', 38);
            $table->string('claim_charge_amount', 18);
            $table->foreignId('place_of_service_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->string('claim_frequency_code', 1);
            $table->foreignId('claim_plan_participation_code_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->boolean('benefits_assignment')->default(false);
            $table->string('release_information_code', 1);
            $table->string('patient_amount_paid', 18);
            $table->string('additional_information', 50);
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
        Schema::dropIfExists('claim_information');
    }
};
