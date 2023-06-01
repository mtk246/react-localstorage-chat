<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('claim_forms_p', function (Blueprint $table) {
            $table->string('type_of_medical_assistance', 10)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('claim_forms_p', function (Blueprint $table) {
            $table->dropColumn('type_of_medical_assistance');
        });
    }
};
