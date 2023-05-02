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
        Schema::create('status_claim_medicals', function (Blueprint $table) {
            $table->id();
            $table->string('status_category_code', 50);
            $table->string('status_category_code_value', 50);
            $table->string('status_code', 50);
            $table->string('status_code_value', 50);
            $table->string('entity_code', 50);
            $table->string('entity', 50);
            $table->string('effective_date', 8);
            $table->float('submitted_amount', 8, 2);
            $table->float('amount_paid', 8, 2);
            $table->string('paid_date', 8);
            $table->string('check_issue_date', 8);
            $table->string('check_number');
            $table->string('tracking_number', 50);
            $table->date('claim_service_date');
            $table->string('trading_partner_claim_number', 50);
            $table->foreignId('claim_status_medical_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('status_claim_medicals');
    }
};
