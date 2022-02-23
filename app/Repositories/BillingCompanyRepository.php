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
            "code" => $data["code"],
        ]);

        $data["address"]["billing_company_id"] = $company->id;
        $data["contact"]["billing_company_id"] = $company->id;

        Address::create($data["address"]);
        Contact::create($data["contact"]);

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
                "code" => $data["code"],
            ]);

            if (isset($data['address'])) {
                $data["address"]["billing_company_id"] = $id;
                $address = Address::updateOrCreate([
                    "billing_company_id" => $billingCompany->id
                ], $data["address"]);
            }
            if (isset($data["contact"])) {
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

    public function getAllBillingCompanyByUser($user_id){
        return User::whereId($user_id)->with([
            "billingCompanyUser",
            "address",
            "contact"
        ])->first();
    }

    public function getAllBillingCompany(){
        return BillingCompany::with([
            "users",
            "address",
            "contact"
        ])->get();
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
