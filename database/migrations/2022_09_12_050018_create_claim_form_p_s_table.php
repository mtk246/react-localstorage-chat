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
        Schema::create('claim_forms_p', function (Blueprint $table) {
            $table->id();
            $table->boolean('head_benefit_plan_other')->default(false);
            $table->date('date_of_current');
            $table->string('total_charge', 50);

            $table->foreignId('type_form_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('type_insurance_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('insurance_policy_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('facility_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('patient_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('relationship_to_insured_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('billing_company_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('claim_forms_p');
    }
};
