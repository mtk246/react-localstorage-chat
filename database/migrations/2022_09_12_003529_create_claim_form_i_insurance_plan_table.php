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
        Schema::create('claim_form_i_insurance_plan', function (Blueprint $table) {
            $table->id();
            $table->boolean('rel_info')->default(false);
            $table->boolean('asg_ben')->default(false);
            $table->string('prior_payments', 50);
            $table->string('est_amount_due', 50);
            $table->foreignId('claim_form_i_id')->constrained('claim_forms_i')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('insurance_plan_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('claim_form_i_insurance_plan');
    }
};
