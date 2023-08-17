<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('claim_date_informations', function (Blueprint $table) {
            $table->dropColumn(['through']);
        });
    }

    public function down(): void
    {
        Schema::table('claim_date_informations', function (Blueprint $table) {
            $table->string('through')->nullable();
        });
    }
};
