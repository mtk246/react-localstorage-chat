<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('physician_or_supplier_informations', function (Blueprint $table) {
            $table->string('condition_code_ids', 50)->nullable();
            $table->date('admission_date')->nullable();
            $table->time('admission_time')->nullable();
            $table->date('discharge_date')->nullable();
            $table->time('discharge_time')->nullable();
            $table->decimal('non_covered_charges', 8, 2)->nullable();

            $table->unsignedBigInteger('admission_type_id')->nullable();
            $table->foreign('admission_type_id', 'posi_admission_type_id_fk')
                ->references('id')
                ->on('type_catalogs')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('admission_source_id')->nullable();
            $table->foreign('admission_source_id', 'posi_admission_source_id_fk')
                ->references('id')
                ->on('type_catalogs')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('patient_status_id')->nullable();
            $table->foreign('patient_status_id', 'posi_patient_status_id_fk')
                ->references('id')
                ->on('type_catalogs')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('bill_classification_id')->nullable();
            $table->foreign('bill_classification_id', 'posi_bill_classification_id_fk')
                ->references('id')
                ->on('type_catalogs')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('diagnosis_related_group_id')->nullable();
            $table->foreign('diagnosis_related_group_id', 'posi_diagnosis_related_group_id_fk')
                ->references('id')
                ->on('type_catalogs')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('physician_or_supplier_informations', function (Blueprint $table) {
            $table->dropForeign('posi_diagnosis_related_group_id_fk');
            $table->dropForeign('posi_bill_classification_id_fk');
            $table->dropForeign('posi_patient_status_id_fk');
            $table->dropForeign('posi_admission_source_id_fk');
            $table->dropForeign('posi_admission_type_id_fk');

            $table->dropColumn('diagnosis_related_group_id');
            $table->dropColumn('bill_classification_id');
            $table->dropColumn('patient_status_id');
            $table->dropColumn('admission_source_id');
            $table->dropColumn('admission_type_id');
            $table->dropColumn('condition_code_ids');
            $table->dropColumn('admission_date');
            $table->dropColumn('admission_time');
            $table->dropColumn('discharge_date');
            $table->dropColumn('discharge_time');
            $table->dropColumn('non_covered_charges');
        });
    }
};
