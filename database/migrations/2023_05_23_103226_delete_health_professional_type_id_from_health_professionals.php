<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('health_professionals', function (Blueprint $table) {
            $table->dropForeign(['health_professional_type_id']);
            $table->dropColumn('health_professional_type_id');
        });
    }

    public function down(): void
    {
        Schema::table('health_professionals', function (Blueprint $table) {
            $table->foreignId('health_professional_type_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
        });
    }
};
