<?php

namespace App\Repositories;

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

    public function getAllBillingCompanyByUser($user_id){
        return User::whereId($user_id)->with([
            "user",
            "user.address",
            "user.contact"
        ])->first();
    }

    public function getAllBillingCompany(){
        return BillingCompany::with([
            "user",
            "user.address",
            "user.contact"
        ])->get();
    }

    public function getByCode($code){
        return BillingCompany::whereCode($code)->first();
    }

    public function getByName($name){
        return BillingCompany::where("name","ilike","%${name}%")->get();
    }
}
