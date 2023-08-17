<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('claim_health_professional', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('field_id')->nullable();
            $table->unsignedBigInteger('qualifier_id')->nullable();
            $table->foreign('qualifier_id', 'chp_qualifier_id_fk')
                ->references('id')
                ->on('type_catalogs')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('claim_id')->nullable();
            $table->foreign('claim_id', 'chp_claim_id_fk')
                    ->references('id')
                    ->on('claims')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            $table->unsignedBigInteger('health_professional_id')->nullable();
            $table->foreign('health_professional_id', 'chp_health_professional_id_fk')
                ->references('id')
                ->on('health_professionals')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claim_health_professional');
    }
};
