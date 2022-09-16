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
        Schema::create('claim_services', function (Blueprint $table) {
            $table->id();
            $table->date('from_service');
            $table->date('to_service');
            $table->decimal('price', 8, 2)->nullable();
            $table->foreignId('std_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('claim_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('modifier_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('procedure_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('rev_center_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('place_of_service_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('type_of_service_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('diagnostic_pointer_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('claim_services');
    }
};
