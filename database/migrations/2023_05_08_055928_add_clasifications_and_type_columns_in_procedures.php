<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('procedures', function (Blueprint $table) {
            $table->string('classification_type')->nullable();
            $table->json('clasifications')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('procedures', function (Blueprint $table) {
            $table->dropColumn(['classification_type', 'clasifications']);
        });
    }
};
