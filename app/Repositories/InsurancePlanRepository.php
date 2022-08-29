<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\InsurancePlan;
use App\Models\PublicNote;
use App\Models\EntityNickname;

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

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            /** Attach billing company */
            $insurancePlan->billingCompanies()->attach($billingCompany->id ?? $billingCompany);

            if (isset($data['nickname'])) {
                EntityNickname::create([
                    'nickname'           => $data['nickname'],
                    'nicknamable_id'     => $insurancePlan->id,
                    'nicknamable_type'   => InsurancePlan::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ]);
            }

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

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            /** Attach billing company */
            if (is_null($insurancePlan->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $insurancePlan->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
            } else {
                $insurancePlan->billingCompanies()->updateExistingPivot($billingCompany->id ?? $billingCompany, [
                    'status' => true,
                ]);
            }

            if (isset($data['nickname'])) {
                EntityNickname::updateOrCreate([
                    'nicknamable_id'     => $insurancePlan->id,
                    'nicknamable_type'   => InsurancePlan::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'nickname'           => $data['nickname'],
                ]);
            }

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
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $insurance = InsurancePlan::whereId($id)->with([
                "nicknames",
                "publicNotes",
                "insuranceCompany",
                "billingCompanies"
            ])->first();
        } else {
            $insurance = InsurancePlan::whereId($id)->with([
                "nicknames" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "publicNotes",
                "insuranceCompany",
                "billingCompanies"
            ])->first();
        }

        return !is_null($insurance) ? $insurance : null;
    }

    /**
     * @return InsurancePlan[]|Collection
     */
    public function getAllInsurancePlan() {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $insurance = InsurancePlan::with([
                "nicknames",
                "publicNotes",
                "insuranceCompany"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        } else {
            $insurance = InsurancePlan::whereHas("billingCompanies", function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                })->with([
                    "nicknames" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    "publicNotes",
                    "insuranceCompany"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        }

        return !is_null($insurance) ? $insurance : null;
    }

    public function getServerAllInsurancePlan(Request $request) {
        $sortBy   = $request->sortBy ?? 'id';
        $sortDesc = $request->sortDesc ?? false;
        $page = $request->page ?? 1;
        $itemsPerPage = $request->itemsPerPage ?? 5;
        $search = $request->search ?? '';

        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $records = InsurancePlan::with([
                "nicknames",
                "publicNotes",
                "insuranceCompany"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->paginate($itemsPerPage);
        } else {
            $records = InsurancePlan::whereHas("billingCompanies", function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                })->with([
                    "nicknames" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    "publicNotes",
                    "insuranceCompany"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->paginate($itemsPerPage);
        }

        return response()->json([
            'pagination'  => [
                'total'       => $records->total(),
                'currentPage' => $records->currentPage(),
                'perPage'     => $records->perPage(),
                'lastPage'    => $records->lastPage()
            ],
            'items' =>  $records->items()
        ], 200);
    }

    public function changeStatus(bool $status,int $id) {
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;
        
        $insurancePlan = InsurancePlan::find($id);
        if (is_null($insurancePlan->billingCompanies()->find($billingCompany->id))) {
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

    public function getList() {
        return getList(InsurancePlan::class);
    }

    public function getListByCompany($id) {
        return getList(InsurancePlan::class, ['name'], ['insurance_company_id' => $id]);
    }
}
