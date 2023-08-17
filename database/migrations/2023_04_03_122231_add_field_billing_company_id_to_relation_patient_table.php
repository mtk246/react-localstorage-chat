<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('maritals', function (Blueprint $table) {
            $table->foreignId('billing_company_id')
                ->nullable()
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
        Schema::table('guarantors', function (Blueprint $table) {
            $table->foreignId('billing_company_id')
                ->nullable()
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
        Schema::table('emergency_contacts', function (Blueprint $table) {
            $table->foreignId('billing_company_id')
                ->nullable()
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
        Schema::table('employments', function (Blueprint $table) {
            $table->foreignId('billing_company_id')
                ->nullable()
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
        Schema::table('social_media', function (Blueprint $table) {
            $table->foreignId('billing_company_id')
                ->nullable()
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('maritals', function (Blueprint $table) {
            $table->dropForeign(['billing_company_id']);
            $table->dropColumn('billing_company_id');
        });
        Schema::table('guarantors', function (Blueprint $table) {
            $table->dropForeign(['billing_company_id']);
            $table->dropColumn('billing_company_id');
        });
        Schema::table('emergency_contacts', function (Blueprint $table) {
            $table->dropForeign(['billing_company_id']);
            $table->dropColumn('billing_company_id');
        });
        Schema::table('employments', function (Blueprint $table) {
            $table->dropForeign(['billing_company_id']);
            $table->dropColumn('billing_company_id');
        });
        Schema::table('social_media', function (Blueprint $table) {
            $table->dropForeign(['billing_company_id']);
            $table->dropColumn('billing_company_id');
        });
    }
};
