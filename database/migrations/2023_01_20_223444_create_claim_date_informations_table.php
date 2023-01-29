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
        Schema::create('claim_date_informations', function (Blueprint $table) {
            $table->id();
            $table->date('from_date_or_current')->nullable();
            $table->date('to_date')->nullable();
            $table->string('description', 100)->nullable();

            $table->foreignId('field_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('qualifier_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('physician_or_supplier_information_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('claim_date_informations');
    }
};
