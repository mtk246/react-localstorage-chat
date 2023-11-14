<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('denial_refile', function (Blueprint $table) {
            $table->integer('temp_refile_reason')->nullable();
        });

        DB::statement('UPDATE denial_refile SET temp_refile_reason = NULLIF(refile_reason, \'\')::INTEGER');

        Schema::table('denial_refile', function (Blueprint $table) {
            $table->dropColumn('refile_reason');
        });

        Schema::table('denial_refile', function (Blueprint $table) {
            $table->renameColumn('temp_refile_reason', 'refile_reason');
        });
    }

    public function down(): void
    {
        Schema::table('denial_refile', function (Blueprint $table) {
            $table->string('refile_reason', 10)->nullable()->change();
        });
    }
};
