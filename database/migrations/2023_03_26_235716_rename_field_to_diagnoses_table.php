<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('diagnoses', function (Blueprint $table) {
            if (Schema::hasColumn('diagnoses', 'long_description')) {
                $table->renameColumn('long_description', 'description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('diagnoses', function (Blueprint $table) {
        });
    }
};
