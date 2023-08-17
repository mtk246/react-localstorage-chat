<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_plans', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name')->unique();
            $table->boolean('status')->default(false);
            $table->string('note');
            $table->string('ins_type');
            $table->string('plan_type');
            $table->string('cap_group');
            $table->boolean('accept_assign')->default(false);
            $table->boolean('pre_authorization')->default(false);
            $table->boolean('file_zero')->default(false);
            $table->boolean('referral_required')->default(false);
            $table->boolean('accrue_patient_resp')->default(false);
            $table->boolean('require_abn')->default(false);
            $table->boolean('pqrs_eligible')->default(false);
            $table->boolean('allow_attached_files')->default(false);
            $table->date('eff_date');
            $table->string('charge_using');
            $table->string('format');
            $table->string('method');
            $table->string('naic');
            $table->foreignIdFor(\App\Models\InsuranceCompany::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insurance_plans');
    }
}
