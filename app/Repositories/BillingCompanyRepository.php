<?php

namespace App\Repositories;

use App\Repositories\BillingCompanyRepository;

use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\Contact;
use App\Models\User;

class BillingCompanyRepository
{
    public function createBillingCompany(array $data){
        $company = BillingCompany::create([
            "name" => $data["name"],
            "code" => generateNewCode("BC", 5, date("Y"), BillingCompany::class, "code")
        ]);

        if (isset($data['address']['address'])) {
            $data["address"]["billing_company_id"] = $company->id;
            $data["address"]["addressable_id"] = $company->id;
            $data["address"]["addressable_type"] = BillingCompany::class;
            Address::create($data["address"]);
        }
        if (isset($data["contact"]["email"])) {
            $data["contact"]["billing_company_id"] = $company->id;
            $data["contact"]["contactable_id"] = $company->id;
            $data["contact"]["contactable_type"] = BillingCompany::class;
            Contact::create($data["contact"]);
        }

        return $company;
    }

    /**
     * @param  array $data
     * @param  int $id
     * @return BillingCompany|Builder|Model|object|null
     */
    public function update(array $data, int $id) {
        $billingCompany = BillingCompany::find($id);
        if (isset($billingCompany)) {
            $billingCompany->update([
                "name" => $data["name"],
            ]);

            if (isset($data['address']['address'])) {
                $data["address"]["billing_company_id"] = $id;
                $address = Address::updateOrCreate([
                    "billing_company_id" => $billingCompany->id
                ], $data["address"]);
            }
            if (isset($data["contact"]["email"])) {
                $data["contact"]["billing_company_id"] = $id;
                $contact = Contact::updateOrCreate([
                    "billing_company_id" => $billingCompany->id
                ], $data["contact"]);
            }
        }
        return $billingCompany;
    }

    public function getBillingCompany($id) {
        return BillingCompany::with([
            "address",
            "contact"
        ])->find($id);
    }

    public function getAllBillingCompanyByUser($user_id) {
        return User::whereId($user_id)->with([
            "billingCompanies",
            "address",
            "contact"
        ])->first();
    }

    public function getAllBillingCompany(){
        return BillingCompany::with([
            "users",
            "address",
            "contact"
        ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
    }

    public function getByCode($code){
        return BillingCompany::whereCode($code)->first();
    }

    public function getByName($name){
        return BillingCompany::where("name","ilike","%${name}%")->get();
    }

    /**
     * @param bool $status
     * @param int $id
     * @return bool|int|null
     */
    public function changeStatus(bool $status, int $id) {
        $billingCompany = BillingCompany::find($id);

        if (is_null($billingCompany)) return null;

        return $billingCompany->update(["status" => $status]);
    }
}
