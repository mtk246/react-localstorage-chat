<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\ClearingHouse;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClearingHouseRepository
{
    /**
     * @param array $data
     * @return ClearingHouse|Model
     */
    public function create(array $data) {
        try {
            DB::beginTransaction();
            $clearing = ClearingHouse::create([
                "code"         => generateNewCode("CH", 5, date("Y"), ClearingHouse::class, "code"),
                "name"         => $data["name"],
                "org_type"     => $data["org_type"],
                "ack_required" => $data["ack_required"]
            ]);
            
            $this->changeStatus(true, $clearing->id);
            $billingCompany = auth()->user()->billingCompanies->first();

            if (isset($data['address']['address'])) {
                $data["address"]["billing_company_id"] = $billingCompany->id ?? null;
                $data["address"]["addressable_id"]     = $clearing->id;
                $data["address"]["addressable_type"]   = ClearingHouse::class;
                Address::create($data["address"]);
            }
            if (isset($data["contact"]["email"])) {
                $data["contact"]["billing_company_id"] = $billingCompany->id ?? null;
                $data["contact"]["contactable_id"]     = $clearing->id;
                $data["contact"]["contactable_type"]   = ClearingHouse::class;
                Contact::create($data["contact"]);
            }
            DB::commit();
            return $clearing;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @return ClearingHouse[]|Collection
     */
    public function getAllClearingHouse() {
        return ClearingHouse::with([
            "addresses",
            "contacts"
        ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
    }

    /**
     * @param int $id
     * @return ClearingHouse|Builder|Model|object|null
     */
    public function getOneClearingHouse(int $id) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $clearing = ClearingHouse::whereId($id)->with([
                "addresses",
                "contacts",
                "billingCompanies"
            ])->first();
        } else {
            $clearing = ClearingHouse::whereId($id)->with([
                "addresses" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "contacts" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "billingCompanies"
            ])->first();
        }

        return !is_null($clearing) ? $clearing : null;
    }

    public function updateClearingHouse(array $data, int $id) {
        try {
            DB::beginTransaction();

            $clearing = ClearingHouse::find($id);
            $clearing->update([
                "name"         => $data["name"],
                "org_type"     => $data["org_type"],
                "ack_required" => $data["ack_required"]
            ]);

            $billingCompany = auth()->user()->billingCompanies->first();

            if (isset($data['contact'])) {
                Contact::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? null,
                    "contactable_id"     => $clearing->id,
                    "contactable_type"   => ClearingHouse::class
                ], $data['contact']);
            }

            if (isset($data['address'])) {
                Address::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? null,
                    "addressable_id"     => $clearing->id,
                    "addressable_type"   => ClearingHouse::class
                ], $data["address"]);
            }
            DB::commit();
            return ClearingHouse::whereId($id)->first();
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    public function getByName(string $name) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $clearing = ClearingHouse::where("name","ILIKE","%${name}%")->with([
                "addresses",
                "contacts",
                "billingCompanies"
            ])->get();
        } else {
            $clearing = ClearingHouse::where("name","ILIKE","%${name}%")->with([
                "addresses" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "contacts" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "billingCompanies"
            ])->get();
        }
        return !is_null($clearing) ? $clearing : null;
    }

    public function changeStatus(bool $status, int $id) {
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;
        
        $clearingHouse = ClearingHouse::find($id);
        if (is_null($clearingHouse->billingCompanies()->find($billingCompany->id))) {
            $clearingHouse->billingCompanies()->attach($billingCompany->id);
            return $clearingHouse;
        } else {
            return $clearingHouse->billingCompanies()->updateExistingPivot($billingCompany->id, [
                'status' => $status,
            ]);
        }
    }

    /**
     * @param  int $id
     * @return ClearingHouse|Builder|Model|object|null
     */
    public function addToBillingCompany(int $id) {
        $clearingHouse = ClearingHouse::find($id);
        if (is_null($clearingHouse)) return null;
        
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;
        
        if (is_null($clearingHouse->billingCompanies()->find($billingCompany->id))) {
            $clearingHouse->billingCompanies()->attach($billingCompany->id);
        }
        return $clearingHouse;
    }
}
