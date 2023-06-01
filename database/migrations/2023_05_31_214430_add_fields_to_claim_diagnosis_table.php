<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('claim_diagnosis', function (Blueprint $table) {
            $table->string('poa', 1)->nullable();
            $table->boolean('admission')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('claim_diagnosis', function (Blueprint $table) {
            $table->dropColumn('poa');
            $table->dropColumn('admission');
        });
    }
};
