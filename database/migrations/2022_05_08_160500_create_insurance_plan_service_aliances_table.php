<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancePlanServiceAliancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_plan_service_aliances', function (Blueprint $table) {
            $table->id();
            $table->double('price');
            $table->boolean('percentage')->default(false);
            $table->unsignedBigInteger('insurance_plan_service_id');
            $table->foreign('ip_service_id')
                ->references('id')
                ->on('insurance_plan_service')
                ->onDelete('restrict')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('insurance_plan_service_aliances');
    }
}
