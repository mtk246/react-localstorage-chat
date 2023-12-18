<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('denial_refile', function (Blueprint $table) {
            $table->string('original_claim_id', 100)->nullable()->change();
            $table->integer('refile_reason')->nullable()->change();
        });
    }

    public function down(): void
    {
    }
};
