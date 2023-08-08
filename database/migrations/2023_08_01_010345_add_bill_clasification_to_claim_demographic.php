<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('claim_demographic', function (Blueprint $table) {
            $table->string('bill_clasification')->nullable()->default(null)->after('type_of_medical_assistance');
        });
    }

    public function down(): void
    {
        Schema::table('claim_demographic', function (Blueprint $table) {
            $table->dropColumn('bill_clasification');
        });
    }
};