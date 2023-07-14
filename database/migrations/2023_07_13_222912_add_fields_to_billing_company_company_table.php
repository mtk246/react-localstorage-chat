<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('billing_company_company', function (Blueprint $table) {
            $table->string('miscellaneous')->nullable();
            $table->string('claim_format_ids')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('billing_company_company', function (Blueprint $table) {
            $table->dropColumn('miscellaneous');
            $table->dropColumn('claim_format_ids');
        });
    }
};
