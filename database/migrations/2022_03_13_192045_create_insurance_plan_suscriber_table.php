<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancePlanSuscriberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_plan_suscriber', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insurance_plan_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('suscriber_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('insurance_plan_suscriber');
    }
}