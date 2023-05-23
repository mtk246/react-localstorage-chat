<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('health_professional_types');
        Schema::create('health_professional_types', function (Blueprint $table) {
            $table->id();
            $table->string('type', 100);
            $table->unsignedBigInteger('health_professional_id')->nullable();
            $table->foreign('health_professional_id', 'hpt_health_professional_id')
                ->references('id')
                ->on('modifiers')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->unsignedBigInteger('billing_company_id')->nullable();
            $table->foreign('billing_company_id', 'hpt_billing_company_id')
                ->references('id')
                ->on('modifiers')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('health_professional_types', function (Blueprint $table) {
            $table->dropForeign(['hpt_billing_company_id', 'hpt_health_professional_id']);
            $table->dropColumn(['billing_company_id', 'health_professional_id']);
        });
    }
};
