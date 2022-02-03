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

        $data["contact"]["company_id"] = $company->id;
        $data["address"]["company_id"] = $company->id;

        Address::create($data["address"]);
        Contact::create($data["contact"]);

        return $company;
    }

    /**
     * @return Company[]|Collection
     */
    public function getAllCompanies(){
        return Company::with([
            "address",
            "contact"
        ])->get();
    }

    /**
     * @param int $id
     * @return Company|Builder|Model|object|null
     */
    public function getOneCompany(int $id){
        $company = Company::whereId($id)->with([
            "address",
            "contact"
        ])->first();

        if(is_null($company)) return null;

        return $company;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Company|Builder|Model|object|null
     */
    public function updateCompany(array $data,int $id){
        if(isset($data["company"])){
            Company::whereId($id)->update($data['company']);
        }

        if(isset($data['address'])){
            $address = Address::whereClearingHouseId($id)->first();

            if( is_null($address) ){
                $data["address"]["clearing_house_id"] = $id;
                Address::create($data["address"]);
            }else{
                Address::whereClearingHouseId($id)->update($data["address"]);
            }

        }

        if(isset($data['contact'])){
            $contact = Contact::whereClearingHouseId($id)->first();

            if( is_null($contact) ){
                $data["address"]["clearing_house_id"] = $id;
                Contact::create($data["address"]);
            }else{
                Contact::whereClearingHouseId($id)->update($data["contact"]);
            }
        }

        return Company::whereId($id)->with([
            "address",
            "contact"
        ])->first();
    }

    /**
     * @param string $email
     * @return Company|Builder|Model|object|null
     */
    public function getOneByEmail(string $email){
        return Company::where("email",$email)->with([
            "address",
            "contact"
        ])->first();
    }

    /**
     * @param string $name
     * @return Company[]|Builder[]|Collection
     */
    public function getByName(string $name){
        return Company::where("name","ILIKE","%${name}%")->with([
            "address",
            "contact"
        ])->get();
    }

    /**
     * @param int $status
     * @param int $id
     * @return bool|int
     */
    public function changeStatus(int $status,int $id){
        return Company::whereId($id)->update(["status"=>$status]);
    }
}
