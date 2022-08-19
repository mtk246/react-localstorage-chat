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
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('ssn');
            $table->string('email');
            $table->date('date_of_birth');
            $table->string('last_name', 30);
            $table->string('first_name', 30);
            $table->string('middle_name', 25);
            $table->string('group_number', 50);
            $table->string('policy_number', 50);
            $table->foreignId('gender_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('billing_company_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('subscribers');
    }
};
