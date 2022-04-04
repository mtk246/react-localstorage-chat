<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\Contact;
use App\Models\EntityNickname;
use App\Models\InsuranceCompany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class InsuranceCompanyRepository
{
    /**
     * @param array $data
     * @return null
     */
    public function createInsurance(array $data) {
        try {
            DB::beginTransaction();
            $insurance = InsuranceCompany::create([
                "code"        => generateNewCode("IC", 5, date("Y"), InsuranceCompany::class, "code"),
                "name"        => $data["insurance"]["name"],
                "naic"        => $data["insurance"]["naic"],
                "file_method" => $data["insurance"]["file_method"]
            ]);
            $this->changeStatus(true, $insurance->id);

            $billingCompany = auth()->user()->billingCompanies->first();

            if (isset($data['insurance']['nickname'])) {
                EntityNickname::create([
                    'nickname'           => $data['insurance']['nickname'],
                    'nicknamable_id'     => $insurance->id,
                    'nicknamable_type'   => InsuranceCompany::class,
                    'billing_company_id' => $billingCompany->id ?? null,
                ]);
            }

            if (isset($data['address']['address'])) {
                $data["address"]["billing_company_id"] = $billingCompany->id ?? null;
                $data["address"]["addressable_id"]     = $insurance->id;
                $data["address"]["addressable_type"]   = InsuranceCompany::class;
                Address::create($data["address"]);
            }
            if (isset($data["contact"]["email"])) {
                $data["contact"]["billing_company_id"] = $billingCompany->id ?? null;
                $data["contact"]["contactable_id"]     = $insurance->id;
                $data["contact"]["contactable_type"]   = InsuranceCompany::class;
                Contact::create($data["contact"]);
            }
            DB::commit();
            return $insurance;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllInsurance() {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $insuranceCompanies = InsuranceCompany::with([
                "addresses",
                "contacts",
                "nicknames"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        } else {
            $insuranceCompanies = InsuranceCompany::whereHas("billingCompanies", function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                })->with([
                    "addresses" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    "contacts" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    "nicknames" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    }
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        }

        return !is_null($insuranceCompanies) ? $insuranceCompanies : null;
    }

    public function getOneInsurance(int $id) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $insurance = InsuranceCompany::whereId($id)->with([
                "addresses",
                "contacts",
                "nicknames",
                "billingCompanies"
            ])->first();
        } else {
            $insurance = InsuranceCompany::whereId($id)->with([
                "addresses" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "contacts" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "nicknames" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "billingCompanies"
            ])->first();
        }

        return !is_null($insurance) ? $insurance : null;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function searchByName(string $name) {
        return InsuranceCompany::where("name","ILIKE","%${name}%")
            ->with([
                "addresses",
                "contacts",
                "billingCompanies"
            ])->get();
    }

    public function changeStatus(bool $status, int $id) {
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;
        
        $insuranceCompany = InsuranceCompany::find($id);
        if (is_null($insuranceCompany->billingCompanies()->find($billingCompany->id))) {
            $insuranceCompany->billingCompanies()->attach($billingCompany->id);
            return $insuranceCompany;
        } else {
            return $insuranceCompany->billingCompanies()->updateExistingPivot($billingCompany->id, [
                'status' => $status,
            ]);
        }
    }

    public function updateInsurance(array $data, int $id) {
        try {
            DB::beginTransaction();
            $insurance = InsuranceCompany::find($id);

            $insurance->update([
                "name"        => $data["insurance"]["name"],
                "naic"        => $data["insurance"]["naic"],
                "file_method" => $data["insurance"]["file_method"]
            ]);

            $this->changeStatus(true, $insurance->id);

            $billingCompany = auth()->user()->billingCompanies->first();

            if (isset($data['insurance']['nickname'])) {
                EntityNickname::updateOrCreate([
                    'nicknamable_id'     => $insurance->id,
                    'nicknamable_type'   => InsuranceCompany::class,
                    'billing_company_id' => $billingCompany->id ?? null,
                ], [
                    'nickname'           => $data['insurance']['nickname'],
                ]);
            }

            if (isset($data['address']['address'])) {
                Address::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? null,
                    "addressable_id"     => $insurance->id,
                    "addressable_type"   => InsuranceCompany::class,
                ],
                $data["address"]);
            }
            if (isset($data["contact"]["email"])) {
                Contact::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? null,
                    "contactable_id"     => $insurance->id,
                    "contactable_type"   => InsuranceCompany::class,
                ], $data["contact"]);
            }
            DB::commit();
            return $insurance;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param  int $id
     * @return InsuranceCompany|Builder|Model|object|null
     */
    public function addToBillingCompany(int $id) {
        $insuranceCompany = InsuranceCompany::find($id);
        if (is_null($insuranceCompany)) return null;
        
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;
        
        if (is_null($insuranceCompany->billingCompanies()->find($billingCompany->id))) {
            $insuranceCompany->billingCompanies()->attach($billingCompany->id);
        }
        return $insuranceCompany;
    }
}
