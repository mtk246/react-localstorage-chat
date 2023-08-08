<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('deceased');
        });
        Schema::table('profiles', function (Blueprint $table) {
            $table->date('deceased_date')->nullable()->default(null);
        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->boolean('deceased')->default(false);
        });
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('deceased_date');
        });
    }
};
