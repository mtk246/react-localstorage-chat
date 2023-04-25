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
        Schema::create('insurance_company_billing_incomplete_reason', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('billing_incomplete_reason_id');
            $table->foreign('billing_incomplete_reason_id', 'fk_icbir_bir_id')
                ->references('id')
                ->on('type_catalogs')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('insurance_company_id');
            $table->foreign('insurance_company_id', 'fk_icbir_insurance_company_id')
                ->references('id')
                ->on('insurance_companies')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('billing_company_id');
            $table->foreign('billing_company_id', 'fk_icbir_billing_company_id')
                ->references('id')
                ->on('billing_companies')
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
        Schema::dropIfExists('insurance_company_billing_incomplete_reason');
    }
};
