<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('diagnoses', function (Blueprint $table) {
            $table->text('description_long')->nullable();
            $table->string('age')->nullable();
            $table->string('age_end')->nullable();

            $table->unsignedBigInteger('gender_id')->nullable();
            $table->foreign('gender_id')->references('id')->on('genders');
        });
    }

    public function down(): void
    {
        Schema::table('diagnoses', function (Blueprint $table) {
            $table->dropForeign(['gender_id']);
            $table->dropColumn(['description_long', 'gender_id', 'age', 'age_end']);
        });
    }
};
