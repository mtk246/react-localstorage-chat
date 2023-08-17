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
        Schema::create('claim_form_i_revenues', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->string('description');
            $table->string('hcpcs', 50);
            $table->date('service_date');
            $table->date('service_units');
            $table->string('total_charges', 50);
            $table->string('non_covered_charges', 50);
            $table->foreignId('claim_form_i_id')->constrained('claim_forms_i')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('claim_form_i_revenues');
    }
};
