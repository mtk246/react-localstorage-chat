<?php

namespace App\Repositories;

use App\Models\BillingCompany;
use App\Models\User;

class BillingCompanyRepository
{

    public function createBillingCompany(array $data){
        return BillingCompany::create($data);
    }

    public function getAllBillingCompanyByUser($user_id){
        return User::whereId($user_id)->billingCompanyUser;
    }

    public function getAllBillingCompany(){
        return BillingCompany::get();
    }
}
