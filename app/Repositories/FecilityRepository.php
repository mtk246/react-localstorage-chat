<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\Contact;
use App\Models\Facility;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FecilityRepository
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
        return Facility::get();
    }

    /**
     * @param int $id
     * @return Facility|Builder|Model|object|null
     */
    public function getOneFacility(int $id){
        $facility = Facility::whereId($id)->first();

        return !is_null($facility) ? $facility : null;
    }
}
