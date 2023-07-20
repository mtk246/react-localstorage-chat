<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('company_service_modifier', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_service_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreignId('modifier_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_service_modifier');
    }
};
