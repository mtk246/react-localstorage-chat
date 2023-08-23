<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('medications', function (Blueprint $table) {
            $table->string('drug_code', 11)->change();
            $table->string('code_NDC', 11)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('medications', function (Blueprint $table) {
            $table->string('drug_code', 10)->change();
            $table->string('code_NDC', 10)->nullable()->change();
        });
    }
};
