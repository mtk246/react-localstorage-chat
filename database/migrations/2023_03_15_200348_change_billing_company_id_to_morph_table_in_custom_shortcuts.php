<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('billing_company_keyboard_shortcut');
        Schema::create('custom_keyboard_shortcuts', function (Blueprint $table) {
            $table->id();
            $table->string('key', 20);
            $table->foreignId('keyboard_shortcut_id')
                ->constrained()
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->morphs('shortcutable');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_keyboard_shortcuts');
        Schema::create('billing_company_keyboard_shortcut', function (Blueprint $table) {
            $table->id();
            $table->string('key', 20);
            $table->foreignId('billing_company_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('keyboard_shortcut_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }
};