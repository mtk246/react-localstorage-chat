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
        Schema::create('claim_form_i_insurance_policy', function (Blueprint $table) {
            $table->id();
            $table->foreignId('claim_form_i_id')->constrained('claim_forms_i')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('insurance_policy_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->integer('prel')->nullable();
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
        Schema::dropIfExists('claim_form_i_insurance_policy');
    }
};
