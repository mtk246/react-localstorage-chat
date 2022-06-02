<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedureFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedure_fees', function (Blueprint $table) {
            $table->id();
            $table->string('label', 50);
            $table->float('fee', 8, 2);
            $table->foreignId('procedure_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('insurance_type_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('procedure_fees');
    }
}
