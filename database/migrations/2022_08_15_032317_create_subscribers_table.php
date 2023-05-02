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
        Schema::dropIfExists('patient_suscriber');
        Schema::dropIfExists('insurance_plan_suscriber');
        Schema::dropIfExists('suscribers');

        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('ssn');
            $table->string('member_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
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
