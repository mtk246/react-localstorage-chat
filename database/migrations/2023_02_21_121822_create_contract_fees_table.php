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
        Schema::create('contract_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('modifier_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('procedure_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('mac_locality_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('insurance_plan_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('billing_company_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('insurance_label_fee_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('contract_fee_type_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
            
            $table->date("start_date");
            $table->date("end_date");
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('price_percentage', 8, 2)->nullable();
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
        Schema::dropIfExists('contract_fees');
    }
};
