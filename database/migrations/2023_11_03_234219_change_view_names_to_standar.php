<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('standar', function (Blueprint $table) {
            DB::unprepared('ALTER VIEW users_information RENAME TO view_users_information');
            DB::unprepared('ALTER VIEW company_information RENAME TO view_company_information');
            DB::unprepared('ALTER VIEW patients_information RENAME TO view_patients_information');
            DB::unprepared('ALTER VIEW health_professional_information RENAME TO view_health_professional_information');
        });
    }

    public function down(): void
    {
        Schema::table('standar', function (Blueprint $table) {
            DB::unprepared('ALTER VIEW view_users_information RENAME TO users_information');
            DB::unprepared('ALTER VIEW view_company_information RENAME TO company_information');
            DB::unprepared('ALTER VIEW view_patients_information RENAME TO patients_information');
            DB::unprepared('ALTER VIEW view_health_professional_information RENAME TO health_professional_information');
        });
    }
};
