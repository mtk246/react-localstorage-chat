<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('patient_information', function (Blueprint $table) {
            $table->date('discharge_date')->nullable()->change();
            $table->time('discharge_time')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('patient_information', function (Blueprint $table) {
            $table->date('discharge_date')->change();
            $table->time('discharge_time')->change();
        });
    }
};
