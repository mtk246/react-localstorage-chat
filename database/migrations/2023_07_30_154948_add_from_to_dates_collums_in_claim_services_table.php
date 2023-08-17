<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('claim_services', function (Blueprint $table) {
            $table->date('from')->nullable()->default(null);
            $table->date('to')->nullable()->default(null);
        });
    }

    public function down(): void
    {
        Schema::table('claim_services', function (Blueprint $table) {
            $table->dropColumn(['from', 'to']);
        });
    }
};
