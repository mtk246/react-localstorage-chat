<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('denial_refile', function (Blueprint $table) {
            $table->date('cross_over_date')->nullable()->change();
        });
    }

    public function down(): void
    {
    }
};
