<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('data_of_payers', function (Blueprint $table) {
            $table->id();
            $table->string('cpid');
            $table->string('paper_cpid')->nullable();
            $table->longText('portal')->nullable();
            $table->unsignedSmallInteger('type');
            $table->string('claim_insurance_type');
            $table->foreignId('clearing_house_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('available_payer_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_of_payers');
    }
};
