<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('billing_companies', function (Blueprint $table) {
            $table->timestamp('disabled_at')->nullable()->after('status');
        });

        Schema::table('billing_company_user', function (Blueprint $table) {
            $table->timestamp('disabled_at')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('disabled_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('billing_companies', function (Blueprint $table) {
            $table->dropColumn('disabled_at');
        });

        Schema::table('billing_company_user', function (Blueprint $table) {
            $table->dropColumn('disabled_at');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('disabled_at');
        });
    }
};
