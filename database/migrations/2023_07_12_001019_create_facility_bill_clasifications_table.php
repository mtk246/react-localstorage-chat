<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facility_bill_clasifications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('facility_id');
            $table->foreign('facility_id')->references('id')->on('facilities');

            $table->unsignedBigInteger('bill_classification_id');
            $table->foreign('bill_classification_id')->references('id')->on('bill_classifications');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facility_bill_clasifications');
    }
};
