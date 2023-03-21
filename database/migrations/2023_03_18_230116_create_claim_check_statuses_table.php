<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('claim_check_statuses', function (Blueprint $table) {
            $table->id();
            $table->longText('response_details')->nullable();
            $table->string('interface_type', 10)->nullable();
            $table->string('interface')->nullable();
            $table->date('consultation_date')->nullable();
            $table->date('resolution_time')->nullable();
            $table->date('past_due_date')->nullable();
            $table->foreignId('private_note_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claim_check_statuses');
    }
};
