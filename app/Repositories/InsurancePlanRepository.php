<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\InsurancePlan;
use App\Models\PublicNote;

class InsurancePlanRepository
{
    /**
     * @param array $data
     * @return null
     */
    public function createInsurancePlan(array $data) {
        try {
            DB::beginTransaction();
            $insurancePlan = InsurancePlan::create([
                "code"                 => generateNewCode("IP", 5, date("Y"), InsurancePlan::class, "code"),
                'name'                 => $data['name'],
                'ins_type'             => $data['ins_type'],
                'cap_group'            => $data['cap_group'],
                'accept_assign'        => $data['accept_assign'],
                'pre_authorization'    => $data['pre_authorization'],
                'file_zero_changes'    => $data['file_zero_changes'],
                'referral_required'    => $data['referral_required'],
                'accrue_patient_resp'  => $data['accrue_patient_resp'],
                'require_abn'          => $data['require_abn'],
                'pqrs_eligible'        => $data['pqrs_eligible'],
                'allow_attached_files' => $data['allow_attached_files'],
                'eff_date'             => $data['eff_date'],
                'charge_using'         => $data['charge_using'],
                'format'               => $data['format'],
                'method'               => $data['method'],
                'naic'                 => $data['naic'],
                'insurance_company_id' => $data['insurance_company_id']
            ]);

            $this->changeStatus(true, $insurancePlan->id);

            $note = PublicNote::create([
                'note' => $data['note'],
                'publishable_id'   => $insurancePlan->id,
                'publishable_type' => InsurancePlan::class,
            ]);
            DB::commit();
            return $insurancePlan;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param array $data
     * @param int $id
     * @return InsurancePlan|Builder|Model|object|null
     */
    public function updateInsurancePlan(array $data, int $id) {

        try {
            DB::beginTransaction();
            $insurancePlan = InsurancePlan::whereId($id)->first();

            $insurancePlan->update([
                'name'                 => $data['name'],
                'ins_type'             => $data['ins_type'],
                'cap_group'            => $data['cap_group'],
                'accept_assign'        => $data['accept_assign'],
                'pre_authorization'    => $data['pre_authorization'],
                'file_zero_changes'    => $data['file_zero_changes'],
                'referral_required'    => $data['referral_required'],
                'accrue_patient_resp'  => $data['accrue_patient_resp'],
                'require_abn'          => $data['require_abn'],
                'pqrs_eligible'        => $data['pqrs_eligible'],
                'allow_attached_files' => $data['allow_attached_files'],
                'eff_date'             => $data['eff_date'],
                'charge_using'         => $data['charge_using'],
                'format'               => $data['format'],
                'method'               => $data['method'],
                'naic'                 => $data['naic'],
                'insurance_company_id' => $data['insurance_company_id']
            ]);

            $this->changeStatus(true, $insurancePlan->id);

            PublicNote::updateOrCreate([
                'publishable_id'   => $insurancePlan->id,
                'publishable_type' => InsurancePlan::class,
            ], ["note" => $data['note']]);

            DB::commit();
            return $insurancePlan;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param  int $id
     * @return InsurancePlan|Builder|Model|object|null
     */
    public function addToBillingCompany(int $id) {
        $insurancePlan = InsurancePlan::find($id);
        if (is_null($insurancePlan)) return null;
        
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;
        
        if (is_null($insuranceCompany->billingCompanies()->find($billingCompany->id))) {
            $insurancePlan->billingCompanies()->attach($billingCompany->id);
        }
        return $insurancePlan;
    }

    /**
     * @param int $id
     * @return InsurancePlan|Builder|Model|object|null
     */
    public function getOneInsurancePlan(int $id) {
        $insurance = InsurancePlan::whereId($id)->with([
            "publicNotes",
            "insuranceCompany",
            "billingCompanies"
        ])->first();

        return !is_null($insurance) ? $insurance : null;
    }

    /**
     * @return InsurancePlan[]|Collection
     */
    public function getAllInsurancePlan() {
        return InsurancePlan::orderBy("created_at", "desc")->orderBy("id", "asc")->get();
    }

    public function changeStatus(bool $status,int $id) {
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;
        
        $insurancePlan = InsurancePlan::find($id);
        if (is_null($insurancePlan->billingCompanies()->find($billingPlan->id))) {
            $insurancePlan->billingCompanies()->attach($billingCompany->id);
            return $insurancePlan;
        } else {
            return $insurancePlan->billingCompanies()->updateExistingPivot($billingCompany->id, [
                'status' => $status,
            ]);
        }
    }

    public function getByName(string $name) {
        return InsurancePlan::where("name","ILIKE","%${name}%")->get();
    }

    public function getByCompany(string $nameCompany) {
        return InsurancePlan::whereHas("insuranceCompany", function(Builder $query) use ($nameCompany) {
            $query->where("name","ILIKE","%${nameCompany}%");
        })->get();
    }

    public function getAllPlanByInsurancePlan(int $id){
        return InsurancePlan::whereInsuranceCompanyId($id)->get();
    }
}
