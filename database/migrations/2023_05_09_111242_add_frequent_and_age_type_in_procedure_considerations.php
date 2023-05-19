<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('procedure_considerations', function (Blueprint $table) {
            $table->tinyInteger('age_type')->default(1);
        });
    }

    public function down(): void
    {
        Schema::table('procedure_considerations', function (Blueprint $table) {
            $table->dropColumn(['age_type']);
        });
    }
};