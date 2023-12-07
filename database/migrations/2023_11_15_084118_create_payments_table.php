<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('source');
            $table->date('payment_date');
            $table->string('currency');
            $table->decimal('total_amount');
            $table->string('payment_method');
            $table->string('reference')->nullable();
            $table->boolean('statement')->default(false);
            $table->string('note');
            $table->foreignId('payment_batch_id')
                ->constrained('payment_batches')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('insurance_company_id')
                ->constrained('insurance_companies')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('payment_cards', function (Blueprint $table) {
            $table->id();
            $table->integer('card_number')->nullable();
            $table->date('expiration_date')->nullable();
            $table->foreignId('payment_id')
                ->constrained('payments')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_cards');
        Schema::dropIfExists('payments');
    }
};
