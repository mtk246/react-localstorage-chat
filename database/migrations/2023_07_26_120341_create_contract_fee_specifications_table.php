<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('contract_fee_specifications', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('contract_fee_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreignId('billing_provider_id')
                ->constrained('health_professionals')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreignId('billing_provider_taxonomy_id')
                ->constrained('taxonomies')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreignId('health_professional_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreignId('health_professional_taxonomy_id')
                ->constrained('taxonomies')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_fee_specifications');
    }
};
