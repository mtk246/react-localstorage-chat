<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('permission', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
            $table->morphs('permissioned');
        });
    }

    public function down(): void
    {
        Schema::table('permission', function (Blueprint $table) {
            $table->dropMorphs('permissioned');
            $table->foreignId('role_id')
                ->nullable()
                ->constrained('membership_roles')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }
};
