<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldsToInsurancePlanPatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insurance_plan_patient', function (Blueprint $table) {
            $table->boolean('status')->default('true');
            $table->boolean('own_insurance')->default('true');

            $table->foreign('insurance_plan_id')->references('id')->on('insurance_plans')
                  ->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')
                  ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurance_plan_patient', function (Blueprint $table) {
            //
        });
    }
}
