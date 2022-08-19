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
        Schema::create('claim_dates', function (Blueprint $table) {
            $table->id();
            $table->date('symptom_date');
            $table->date('initial_treatment_date');
            $table->date('last_seen_date');
            $table->date('acute_manifestation_date');
            $table->date('accident_date');
            $table->date('last_menstrual_period_date');
            $table->date('last_x_ray_date');
            $table->date('hearing_and_vision_prescription_date');
            $table->date('disability_date');
            $table->date('disability_begin_date');
            $table->date('disability_end_date');
            $table->date('last_worked_date');
            $table->date('authorized_return_to_work_date');
            $table->date('admission_date');
            $table->date('discharge_date');
            $table->date('assumed_and_relinquished_care_begin_date');
            $table->date('assumed_and_relinquished_care_end_date');
            $table->date('first_contact_date');
            $table->foreignId('claim_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('claim_dates');
    }
};
