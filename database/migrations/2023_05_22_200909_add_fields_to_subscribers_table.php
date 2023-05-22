<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->dropUnique(['ssn']);
            $table->foreignId('name_suffix_id')
                ->nullable()
                ->constrained('type_catalogs')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->string('sex', 1)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->dropForeign(['name_suffix_id']);
            $table->dropColumn('name_suffix_id');
            $table->dropColumn('sex');
        });
    }
};
