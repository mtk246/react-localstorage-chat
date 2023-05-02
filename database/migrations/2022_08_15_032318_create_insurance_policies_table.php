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
        Schema::create('insurance_policies', function (Blueprint $table) {
            $table->id();
            $table->string('policy_number', 50);
            $table->string('group_number', 50)->nullable();
            $table->string('payment_responsibility_level_code', 2)->nullable();
            $table->date('eff_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('copay', 50)->nullable();
            $table->boolean('release_info')->default(false);
            $table->boolean('assign_benefits')->default(false);

            $table->foreignId('insurance_plan_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('insurance_policies');
    }
};
