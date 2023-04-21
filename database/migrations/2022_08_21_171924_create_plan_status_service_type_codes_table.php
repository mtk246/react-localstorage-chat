<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_status_service_type_codes', function (Blueprint $table) {
            $table->id();
            $table->string('service_type_code');
            $table->unsignedBigInteger('claim_eligibility_plan_status_id');
            $table->foreign('claim_eligibility_plan_status_id', 'fk_psstc_ceps_id')
                ->references('id')
                ->on('claim_eligibility_plan_statuses')
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
        Schema::dropIfExists('plan_status_service_type_codes');
    }
};
