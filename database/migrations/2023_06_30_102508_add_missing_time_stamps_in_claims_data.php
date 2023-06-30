<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('claim_demographic', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('patient_information', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('claim_services', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('services', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('claim_demographic', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('patient_information', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('claim_services', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('services', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};
