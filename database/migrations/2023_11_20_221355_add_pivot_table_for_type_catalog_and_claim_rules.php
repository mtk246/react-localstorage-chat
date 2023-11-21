<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('claim_rule_type_responsibility', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('claim_rule_id')->constrained('claim_rules')->cascadeOnDelete();
            $table->foreignId('type_responsibility_id')
                ->constrained('type_catalogs')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claim_rule_type_responsibility');
    }
};
