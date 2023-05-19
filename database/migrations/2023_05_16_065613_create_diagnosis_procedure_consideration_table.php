<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('diagnosis_procedure_consideration', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diagnosis_id');
            $table->foreign('diagnosis_id', 'dpc_diagnosis_id')
                ->references('id')
                ->on('diagnoses')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->unsignedBigInteger('procedure_consideration_id');
            $table->foreign('procedure_consideration_id', 'dpc_p_consideration_id')
                ->references('id')
                ->on('procedure_considerations')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnosis_procedure_consideration');
    }
};
