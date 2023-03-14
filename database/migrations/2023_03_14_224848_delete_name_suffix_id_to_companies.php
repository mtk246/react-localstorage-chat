<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['name_suffix_id']);
            $table->dropColumn('name_suffix_id');
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->foreignId('name_suffix_id')
                ->nullable()
                ->constrained('type_catalogs')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
        });
    }
};
