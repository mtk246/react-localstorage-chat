<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\Contact;
use App\Models\InsuranceCompany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class InsuranceCompanyRepository
{
    /**
     * @param string $name
     * @return mixed
     */
    public function searchByName(string $name) {
        return InsuranceCompany::where("name","ILIKE","%${name}%")
            ->with([
                "address",
                "contact"
            ])
            ->get();
    }

    /**
     * @param array $data
     * @return null
     */
    public function createInsurance(array $data) {
        try {
            $data["insurance"]["code"] = randomNumber(6);
            $insurance = InsuranceCompany::create($data["insurance"]);
            $this->changeStatus(true, $insurance->id);

            if (isset($data["address"])) {
                $data['address']['insurance_company_id'] = $insurance->id;
                Address::create($data["address"]);
            }

            if (isset($data["address"])) {
                $data['contact']['insurance_company_id'] = $insurance->id;
                Contact::create($data['contact']);
            }

            return $insurance->load("address")->load("contact");
        }catch (\Exception $e){
            return null;
        }
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllInsurance() {
        return InsuranceCompany::with([
            "address",
            "contact"
        ])->get();
    }

    public function getOneInsurance(int $id) {
        $insurance = InsuranceCompany::with([
            "address",
            "contact"
        ])->where("id",$id)->first();

        if(is_null($insurance)) return null;

        return $insurance;
    }

    public function changeStatus(bool $status, int $id) {
        $billingCompany = auth()->user()->billingCompanyUser->first();
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
        if (isset($data['insurance'])) {
            $insurance = InsuranceCompany::find($id);
            $insurance->update($data["insurance"]);
        }

        if (isset($data['address'])) {
            Address::whereInsuranceCompanyId($id)->update($data['address']);
        }

        if (isset($data["contact"])) {
            Contact::whereInsuranceCompanyId($id)->update($data['contact']);
        }

        return InsuranceCompany::whereId($id)->with([
            "address",
            "contact"
        ])->first();
    }

    /**
     * @param  int $id
     * @return InsuranceCompany|Builder|Model|object|null
     */
    public function addToBillingCompany(int $id) {
        $insuranceCompany = InsuranceCompany::find($id);
        if (is_null($insuranceCompany)) return null;
        
        $billingCompany = auth()->user()->billingCompanyUser->first();
        if (is_null($billingCompany)) return null;
        
        if (is_null($insuranceCompany->billingCompanies()->find($billingCompany->id))) {
            $insuranceCompany->billingCompanies()->attach($billingCompany->id);
        }
        return $insuranceCompany;
    }
}
