<?php

namespace App\Repositories;

use App\Models\Address;
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
    public function searchByName(string $name){
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
    public function createInsurance(array $data){
        try{
            $data["insurance"]["code"] = randomNumber(6);
            $insurance = InsuranceCompany::create($data["insurance"]);

            if(isset($data["address"])){
                $data['address']['insurance_company_id'] = $insurance->id;
                Address::create($data["address"]);
            }

            if(isset($data["address"])){
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
    public function getAllInsurance(){
        return InsuranceCompany::with([
            "address",
            "contact"
        ])->get();
    }

    public function getOneInsurance(int $id){
        $insurance = InsuranceCompany::with([
            "address",
            "contact"
        ])->where("id",$id)->first();

        if(is_null($insurance)) return null;

        return $insurance;
    }

    public function changeStatus(bool $status,int $id){
        return InsuranceCompany::whereId($id)->update([
            "status" => $status
        ]);
    }

    public function updateInsurance(array $data,int $id){
        if(isset($data['insurance'])){
            InsuranceCompany::whereId($id)->update($data["insurance"]);
        }

        if(isset($data['address'])){
            Address::whereInsuranceCompanyId($id)->update($data['address']);
        }

        if(isset($data["contact"])){
            Contact::whereInsuranceCompanyId($id)->update($data['contact']);
        }

        return InsuranceCompany::whereId($id)->with([
            "address",
            "contact"
        ])->first();
    }
}
