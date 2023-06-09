<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('diagnoses', function (Blueprint $table) {
            $table->string('code', 50)->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('diagnoses', function (Blueprint $table) {
            $table->dropUnique('diagnoses_code_unique');
            $table->string('code', 50)->change();
        });
    }
};
