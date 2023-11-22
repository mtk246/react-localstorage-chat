<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('standar', function (Blueprint $table) {
            DB::unprepared('ALTER VIEW view_general_facility RENAME COLUMN billing_companies_ids TO billing_id');
        });
    }

    public function down(): void
    {
        Schema::table('standar', function (Blueprint $table) {
            DB::unprepared('ALTER VIEW view_general_facility RENAME COLUMN billing_id TO billing_companies_ids');
        });
    }
};
