<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employments', function (Blueprint $table) {
            $table->string('employer_name')->nullable()->change();
            $table->string('employer_address')->nullable()->change();
            $table->string('employer_phone')->nullable()->change();
            $table->string('position')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('employments', function (Blueprint $table) {
            $table->string('employer_name')->change();
            $table->string('employer_address')->change();
            $table->string('employer_phone')->change();
            $table->string('position')->change();
        });
    }
};
