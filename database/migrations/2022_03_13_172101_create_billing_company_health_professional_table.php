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
            $table->foreignId('billing_company_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('health_professional_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
