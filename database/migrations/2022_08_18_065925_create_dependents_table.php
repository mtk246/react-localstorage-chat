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
        Schema::create('dependents', function (Blueprint $table) {
            $table->id();
            $table->string('member_id', 80);
            $table->string('policy_number', 80);
            $table->foreignId('subscriber_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('patient_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('relationship_to_subscriber_code_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('payment_responsibility_level_code_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('dependents');
    }
};
