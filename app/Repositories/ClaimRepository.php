<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\TypeOfService;
use App\Models\PlaceOfService;
use App\Models\TypeForm;
use App\Models\StatusClaim;
use App\Models\Claim;
use App\Models\ClaimFormP;
use App\Models\ClaimFormPService;

class claimRepository
{
    /**
     * @param array $data
     * @return claim|Model
     */
    public function createClaim(array $data) {
        try {
            DB::beginTransaction();
            $newCode = 1;
            $targetModel = Claim::select("id")->orderBy('created_at', 'desc')->orderBy('id', 'desc')->first();
            
            $newCode += ($targetModel) ? (int)explode('-', $targetModel->$field)[1] : 0;
            $newCode = str_pad($newCode, 9, "0", STR_PAD_LEFT);

            $claim = Claim::create([
                "control_number"         => $newCode,
                "company_id"             => $data["company_id"],
                "facility_id"            => $data["facility_id"],
                "patient_id"             => $data["patient_id"],
                "health_professional_id" => $data["health_professional_id"]
            ]);

            if (isset($data['diagnoses'])) {
                $claim->diagnoses()->detach();
                foreach ($data['diagnoses'] as $diagnosis) {
                    $claim->diagnoses()->attach($diagnosis['diagnosis_id'], ['item' => $diagnosis['item']]);
                }
            }

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            if (isset($data['claim_services'])) {
                $claimFormP = ClaimFormP::create([
                    'type_form_id' => $data['format'],
                    'billing_company_id' => $billingCompany->id ?? $billingCompany
                ]);
                $claimFormP->claimFormPServices()->delete();
                foreach ($data['claim_services'] as $service) {
                    $service["claim_form_p_id"] = $claimFormP->id;
                    ClaimFormPService::create($service);
                }
            }

            if (isset($data['insurance_policies'])) {
                $claim->insurancePolicies()->sync($data['insurance_policies']);
            }

            DB::commit();
            return $claim;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    /**
     * @return claim[]|Collection
     */
    public function getAllClaims() {
        $claims = Claim::with([
            "company",
            "patient"
        ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        return is_null($claims) ? null : $claims;
    }

    /**
     * @param int $id
     * @return claim|Builder|Model|object|null
     */
    public function getOneclaim(int $id) {
        $claim = claim::with([
            "diagnoses",
            "insurancePolicies"
        ])->whereId($id)->first();

        return !is_null($claim) ? $claim : null;
    }

    /**
     * @param array $data
     * @param int $id
     * @return claim|Builder|Model|object|null
     */
    public function updateClaim(array $data, int $id) {
        try {
            DB::beginTransaction();
            $claim = Claim::find($id);
            $claim->update([
                "company_id"             => $data["company_id"],
                "facility_id"            => $data["facility_id"],
                "patient_id"             => $data["patient_id"],
                "health_professional_id" => $data["health_professional_id"]
            ]);

            if (isset($data['diagnoses'])) {
                $claim->diagnoses()->detach();
                foreach ($data['diagnoses'] as $diagnosis) {
                    $claim->diagnoses()->attach($diagnosis['diagnosis_id'], ['item' => $diagnosis['item']]);
                }
            }

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            if (isset($data['claim_services'])) {
                $claimFormP = ClaimFormP::create([
                    'type_form_id' => $data['format'],
                    'billing_company_id' => $billingCompany->id ?? $billingCompany
                ]);
                $claimFormP->claimFormPServices()->delete();
                foreach ($data['claim_services'] as $service) {
                    $service["claim_form_p_id"] = $claimFormP->id;
                    ClaimFormPService::create($service);
                }
            }

            DB::commit();
            return Claim::whereId($id)->first();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function getListTypeOfServices() {
        return getList(TypeOfService::class, ['code', '-', 'name']);
    }

    public function getListPlaceOfServices() {
        return getList(PlaceOfService::class, ['code', '-', 'name']);
    }

    public function getListRevCenters() {
        return getList(RevCenter::class, 'code');
    }

    public function getListTypeFormats() {
        return getList(TypeForm::class, 'form');
    }

    public function getListStatus() {
        return getList(StatusClaim::class, 'status');
    }
}
