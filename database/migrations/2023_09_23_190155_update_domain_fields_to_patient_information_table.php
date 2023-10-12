<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('patient_information', function (Blueprint $table) {
            $table->json('condition_code_ids')->nullable()->change();
            $table->string('admission_type_id')->nullable()->change();
            $table->string('admission_source_id')->nullable()->change();
            $table->string('patient_status_id')->nullable()->change();
            $table->string('bill_classification_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('patient_information', function (Blueprint $table) {
            $table->json('condition_code_ids')->change();
            $table->string('admission_type_id')->change();
            $table->string('admission_source_id')->change();
            $table->string('patient_status_id')->change();
            $table->string('bill_classification_id')->change();
        });
    }
};
