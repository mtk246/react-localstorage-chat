<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropForeign(['facility_type_id']);
            $table->dropColumn(['abbreviation', 'facility_type_id']);
        });
    }

    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->string('abbreviation')->nullable();

            $table->unsignedBigInteger('facility_type_id');
            $table->foreign('facility_type_id')->references('id')->on('facility_types');
        });
    }
};
