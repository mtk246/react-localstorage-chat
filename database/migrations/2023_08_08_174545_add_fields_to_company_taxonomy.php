<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('company_taxonomy', function (Blueprint $table) {
            $table->unsignedBigInteger('billing_company_id')->nullable();
            $table->foreign('billing_company_id')
                    ->references('id')->on('billing_companies')->onDelete('set null');

            $table->boolean('primary')->nullable()->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('company_taxonomy', function (Blueprint $table) {
            $table->dropForeign(['billing_company_id']);
            $table->dropColumn(['billing_company_id', 'primary']);
        });
    }
};
