<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancePlanProcedureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_plan_procedure', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insurance_plan_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('procedure_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->float('price', 8, 2);
            $table->float('price_percentage', 8, 2);
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
        Schema::dropIfExists('insurance_plan_procedure');
    }
}
