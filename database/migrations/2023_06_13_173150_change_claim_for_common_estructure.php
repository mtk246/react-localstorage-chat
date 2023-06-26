<?php

declare(strict_types=1);

use App\Models\Claims\Claim;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('claim_date_informations', function (Blueprint $table) {
            $table->dropColumn('physician_or_supplier_information_id');
            $table->renameColumn('from_date_or_current', 'from_date');
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('claim_eligibility_benefits_information');
        Schema::dropIfExists('claim_eligibility_benefits_information_others');
        Schema::dropIfExists('claim_eligibility_payers');
        Schema::dropIfExists('plan_status_service_type_codes');
        Schema::dropIfExists('claim_eligibility_plan_statuses');
        Schema::dropIfExists('claim_eligibility_trace_numbers');
        Schema::dropIfExists('claim_form_i_code_amounts');
        Schema::dropIfExists('claim_form_i_condition_codes');
        Schema::dropIfExists('claim_form_i_insurance_plan');
        Schema::dropIfExists('claim_form_i_insurance_policy');
        Schema::dropIfExists('claim_form_i_occurrences');
        Schema::dropIfExists('claim_form_i_procedure');
        Schema::dropIfExists('claim_form_i_revenues');
        Schema::dropIfExists('claim_form_i_treatment_authorization_codes');
        Schema::dropIfExists('claim_form_p_services');
        Schema::dropIfExists('claim_form_i_diagnosis');
        Schema::dropIfExists('status_claim_medicals');
        Schema::dropIfExists('physician_or_supplier_informations');
        Schema::dropIfExists('patient_or_insured_informations');
        Schema::dropIfExists('claim_forms_i');
        Schema::dropIfExists('claim_forms_p');
        Schema::dropIfExists('claim_injury');
        Schema::dropIfExists('claim_status_medicals');
        Schema::enableForeignKeyConstraints();

        Claim::query()->delete();

        Schema::table('claims', function (Blueprint $table) {
            $table->dropColumn([
                'company_id',
                'facility_id',
                'patient_id',
                'billing_provider_id',
                'service_provider_id',
                'referred_id',
                'referred_provider_role_id',
                'validate',
                'automatic_eligibility',
                'claim_formattable_id',
                'claim_formattable_type',
                'qr_claim',
            ]);
            $table->foreignId('billing_company_id')
                ->nullable()
                ->constrained('billing_companies')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->renameColumn('control_number', 'code');
            $table->string('format');
            $table->string('type')->default('institutional');
            $table->json('aditional_information');
        });

        Schema::table('claims', function (Blueprint $table) {
            $table->ulid('code')->change();
        });

        Schema::create('claim_demographic', function (Blueprint $table) {
            $table->id();
            $table->foreignId('claim_id')
                ->constrained('claims')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->string('type_of_medical_assistance');
            $table->foreignId('company_id')
                ->nullable()
                ->constrained('companies')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreignId('facility_id')
                ->nullable()
                ->constrained('facilities')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreignId('patient_id')
                ->nullable()
                ->constrained('patients')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->string('prior_authorization_number');
            $table->string('charges');
            $table->string('auto_accident_place_state');
            $table->boolean('accept_assignment');
            $table->boolean('patient_signature');
            $table->boolean('insured_signature');
            $table->boolean('outside_lab');
            $table->boolean('employment_related_condition');
            $table->boolean('auto_accident_related_condition');
            $table->boolean('other_accident_related_condition');
            $table->boolean('validate')->default(true);
            $table->boolean('automatic_eligibility')->default(true);
        });
        Schema::create('patient_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('claim_id')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->date('admission_date');
            $table->time('admission_time');
            $table->date('discharge_date');
            $table->time('discharge_time');
            $table->json('condition_code_ids');
            $table->string('admission_type_id');
            $table->string('admission_source_id');
            $table->string('patient_status_id');
            $table->string('bill_classification_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claim_demographic');
        Schema::dropIfExists('patient_information');

        Schema::table('claims', function (Blueprint $table) {
            $table->dropColumn([
                'code',
                'format',
                'type',
                'aditional_information',
                'billing_company_id',
            ]);

            $table->string('qr_claim', 50)->nullable();
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('facility_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('patient_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->nullableMorphs('claim_formattable');
            $table->boolean('validate')->default(true)->change();
            $table->boolean('automatic_eligibility')->default(true);
            $table->foreignId('billing_provider_id')->nullable()->constrained('health_professionals')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('service_provider_id')->nullable()->constrained('health_professionals')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('referred_id')->nullable()->constrained('health_professionals')->onDelete('restrict')->onUpdate('cascade');
        });

        Schema::table('claim_date_informations', function (Blueprint $table) {
            $table->renameColumn('from_date', 'from_date_or_current');
            $table->unsignedBigInteger('physician_or_supplier_information_id');
            $table->foreign('physician_or_supplier_information_id', 'fk_cdi_psi_id')
                ->references('id')
                ->on('physician_or_supplier_informations')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }
};
