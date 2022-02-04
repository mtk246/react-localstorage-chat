<?php

namespace App\Repositories;


use App\Models\InsurancePlan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class InsurancePlanRepository
{
    /**
     * @param array $data
     * @return null
     */
    public function createInsurancePlan(array $data){
        $data["code"] = randomNumber(6);
        $ip = InsurancePlan::create($data);

        if($ip) return $ip;

        return null;
    }

    /**
     * @param array $data
     * @param int $id
     * @return InsurancePlan|Builder|Model|object|null
     */
    public function updateInsurancePlan(array $data, int $id){
        $uip = InsurancePlan::whereId($id)->first();

        if(is_null($uip)) return null;
        $uip->update($data);
        return InsurancePlan::whereId($id)->first();
    }

    /**
     * @param int $id
     * @return InsurancePlan|Builder|Model|object|null
     */
    public function getOneInsurancePlan(int $id){
        $ip = InsurancePlan::whereId($id)->first();

        if(is_null($ip)) return null;

        return $ip;
    }

    /**
     * @return InsurancePlan[]|Collection
     */
    public function getAllInsurancePlan(){
        return InsurancePlan::get();
    }

    public function changeStatus(bool $status,int $id){
        return InsurancePlan::whereId($id)->update(["status" => $status]);
    }

    public function getByName(string $name){
        return InsurancePlan::where("name","ILIKE","%${name}%")->get();
    }

    public function getByCompany(string $nameCompany){
        return InsurancePlan::whereHas("insuranceCompany",function(Builder $query) use ($nameCompany){
            $query->where("name","ILIKE","%${nameCompany}%");
        })->get();
    }
}
