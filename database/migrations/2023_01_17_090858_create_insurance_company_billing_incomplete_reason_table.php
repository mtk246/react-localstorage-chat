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
        Schema::create('insurance_company_billing_incomplete_reason', function (Blueprint $table) {
            $table->id();
            $table->foreignId('billing_incomplete_reason_id')->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('insurance_company_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('billing_company_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
