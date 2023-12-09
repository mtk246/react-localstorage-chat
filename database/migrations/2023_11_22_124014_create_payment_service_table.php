<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('payment_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained('claim_payment')->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->foreignId('claim_id')->constrained()->cascadeOnDelete();
            $table->string('currency');
            $table->string('payment');
            $table->string('exp_adj');
            $table->string('remain');
            $table->string('ins_amount');
            $table->string('resp_insurance');
            $table->string('pt_resp');
            $table->string('reason');
            $table->string('denial_reason');
            $table->string('note');
            $table->timestamps();
        });

        Schema::create('payment_adjustments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_service_id')->constrained()->cascadeOnDelete();
            $table->string('currency');
            $table->string('amount');
            $table->string('adj_reason');
            $table->timestamps();
        });

        Schema::create('payment_refiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_service_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->foreignId('policy_id')->nullable()->constrained('insurance_policies')->cascadeOnDelete();
            $table->date('date');
            $table->foreignId('claim')->nullable()->constrained()->cascadeOnDelete();
            $table->string('reason');
            $table->string('note');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_adjustments');
        Schema::dropIfExists('payment_services');
    }
};
