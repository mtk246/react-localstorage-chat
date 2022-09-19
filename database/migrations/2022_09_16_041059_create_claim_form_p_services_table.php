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
        Schema::create('claim_form_p_services', function (Blueprint $table) {
            $table->id();
            $table->date('from_service');
            $table->date('to_service');
            $table->decimal('price', 8, 2)->nullable();
            $table->integer('epstd')->nullable();
            $table->integer('rev')->nullable();
            $table->string('diagnostic_pointers', 20)->nullable();
            
            $table->foreignId('claim_form_p_id')->constrained('claim_forms_p')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('modifier_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('procedure_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('place_of_service_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('type_of_service_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('claim_form_p_services');
    }
};
