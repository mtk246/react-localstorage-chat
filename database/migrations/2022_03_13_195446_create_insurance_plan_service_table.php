<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancePlanServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_plan_service', function (Blueprint $table) {
            $table->id();
            $table->double('price');
            $table->boolean('aliance')->default(false);
            $table->foreignId('insurance_plan_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('insurance_plan_service');
    }
}
