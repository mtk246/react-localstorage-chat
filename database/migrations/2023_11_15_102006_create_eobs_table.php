<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('payment_eobs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date');
            $table->string('file_name');
            $table->foreignId('payment_id')
                ->constrained('payments')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_eobs');
    }
};
