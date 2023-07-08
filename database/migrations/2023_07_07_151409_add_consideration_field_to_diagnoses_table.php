<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('diagnoses', function (Blueprint $table) {
            $table->unsignedBigInteger('discriminatory_id')->nullable();
            $table->foreign('discriminatory_id')->references('id')->on('discriminatories');
        });
    }

    public function down(): void
    {
        Schema::table('diagnoses', function (Blueprint $table) {
            $table->dropForeign(['discriminatory_id']);
            $table->dropColumn(['discriminatory_id']);
        });
    }
};
