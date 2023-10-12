<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('billing_company_company', function (Blueprint $table) {
            $table->boolean('split_company_claim')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('billing_company_company', function (Blueprint $table) {
            $table->dropColumn('split_company_claim');
        });
    }
};
