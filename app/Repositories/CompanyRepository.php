<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\Address;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CompanyRepository
{
    /**
     * @param array $data
     * @return Company|Model
     */
    public function createCompany(array $data){
        $company = Company::create($data["company"]);

        $data["contact"]["facility_id"] = $company->id;
        $data["address"]["facility_id"] = $company->id;

        Address::create($data["address"]);
        Contact::create($data["contact"]);

        return $company;
    }

    /**
     * @return Company[]|Collection
     */
    public function getAllCompanies(){
        return Company::get();
    }

    /**
     * @param int $id
     * @return Company|Builder|Model|object|null
     */
    public function getOneCompany(int $id){
        $company = Company::whereId($id)->first();

        if(is_null($company)) return null;

        return $company;
    }
}
