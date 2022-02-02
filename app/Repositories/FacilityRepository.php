<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\Contact;
use App\Models\Facility;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class FacilityRepository
{
    /**
     * @param array $data
     * @return Facility|Model
     */
    public function create(array $data){
        $facility = Facility::create($data["facility"]);

        $data["contact"]["facility_id"] = $facility->id;
        $data["address"]["facility_id"] = $facility->id;

        Address::create($data["address"]);
        Contact::create($data["contact"]);

        return $facility;
    }

    /**
     * @return Facility[]|Collection
     */
    public function getAllFacilities(){
        return Facility::with([
            "address",
            "contact"
        ])->get();
    }

    /**
     * @param int $id
     * @return Facility|Builder|Model|object|null
     */
    public function getOneFacility(int $id){
        $facility = Facility::whereId($id)->with([
            "address",
            "contact"
        ])->first();

        return !is_null($facility) ? $facility : null;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Facility|Builder|Model|object|null
     */
    public function updateCompany(array $data,int $id){
        if(isset($data["facility"])){
            Facility::whereId($id)->update($data['company']);
        }

        if(isset($data["address"])){
            Facility::whereId($id)->update($data['address']);
        }

        if(isset($data["contact"])){
            Facility::whereId($id)->update($data['contact']);
        }

        return Facility::whereId($id)->with([
            "address",
            "contact"
        ])->first();
    }

    /**
     * @param string $name
     * @return Facility[]|Builder[]|Collection
     */
    public function getByName(string $name){
        return Facility::where("name","ilike","%${name}%")->get();
    }

    /**
     * @param boolean $status
     * @param int $id
     * @return bool|int
     */
    public function changeStatus(Boolean $status,int $id){
        return Facility::whereId($id)->update(["status"=>$status]);
    }
}
