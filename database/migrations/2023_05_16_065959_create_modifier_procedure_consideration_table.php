<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('modifier_procedure_consideration', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('modifier_id');
            $table->foreign('modifier_id', 'mpc_modifier_id')
                ->references('id')
                ->on('modifiers')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->unsignedBigInteger('procedure_consideration_id');
            $table->foreign('procedure_consideration_id', 'mpc_p_consideration_id')
                ->references('id')
                ->on('procedure_considerations')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modifier_procedure_consideration');
    }
};
