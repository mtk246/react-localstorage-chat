<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingCompanyHealthProfessionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_company_health_professional', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('billing_company_id');
            $table->foreign('billing_company_id', 'bchp_bc_id')
                ->references('id')
                ->on('billing_companies')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('health_professional_id');
            $table->foreign('health_professional_id', 'bchp_hp_id')
                ->references('id')
                ->on('health_professionals')
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
        Schema::dropIfExists('billing_company_health_professional');
    }
}
