<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('modifiers', function (Blueprint $table) {
            $table->text('special_coding_instructions')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('modifiers', function (Blueprint $table) {
            $table->text('special_coding_instructions')->change();
        });
    }
};
