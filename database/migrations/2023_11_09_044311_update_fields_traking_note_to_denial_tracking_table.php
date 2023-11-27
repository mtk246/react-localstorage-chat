<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('denial_tracking');

        Schema::create('denial_tracking', function (Blueprint $table) {
            $table->id();
            $table->integer('interface_type');
            $table->boolean('is_reprocess_claim')->default(false);
            $table->boolean('is_contact_to_patient')->default(false);
            $table->string('contact_through', 100)->nullable();
            $table->string('claim_number', 100)->nullable();
            $table->string('rep_name', 100)->nullable();
            $table->string('ref_number', 100)->nullable();
            $table->bigInteger('claim_status');
            $table->bigInteger('claim_sub_status')->nullable();

            $table->date('tracking_date');
            $table->date('resolution_time')->nullable();
            $table->date('past_due_date')->nullable();
            $table->date('follow_up');
            $table->string('department_responsible', 50)->nullable();
            $table->string('policy_responsible', 50);

            $table->timestamps();
            $table->text('response_details')->nullable();
            $table->foreignId('claim_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreignId('private_note_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('denial_tracking');

        Schema::create('denial_tracking', function (Blueprint $table) {
            $table->id();
            $table->integer('interface_type');
            $table->boolean('is_reprocess_claim')->default(false);
            $table->boolean('is_contact_to_patient')->default(false);
            $table->string('contact_through', 100);
            $table->string('rep_name', 100);
            $table->string('ref_number', 100);
            $table->string('status_claim', 100);
            $table->string('sub_status_claim', 100);
            $table->date('tracking_date');
            $table->date('past_due_date');
            $table->date('follow_up');
            $table->string('department_responsible', 50);
            $table->string('policy_responsible', 50);
            $table->string('tracking_note', 255);
            $table->timestamps();
            $table->unsignedBigInteger('claim_id');
            $table->foreign('claim_id')->references('id')->on('claims')->onDelete('cascade');
        });
    }
};
