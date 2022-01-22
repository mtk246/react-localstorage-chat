<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\ClearingHouse;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ClearingHouseRepository
{
    /**
     * @param array $data
     * @return ClearingHouse|Model
     */
    public function create(array $data){
        $clearing = ClearingHouse::create([
            "code" => $data["code"],
            "name" => $data["name"],
        ]);

        $data["address"]["clearing_house_id"] = $clearing->id;
        $data["contact"]["clearing_house_id"] = $clearing->id;

        Address::create($data["address"]);
        Contact::create($data["contact"]);

        return $clearing;
    }

    /**
     * @return ClearingHouse[]|Collection
     */
    public function getAllClearingHouse(){
        return ClearingHouse::get();
    }

    /**
     * @param int $clearing_id
     * @return ClearingHouse|Builder|Model|object|null
     */
    public function getOneClearingHouse(int $clearing_id){
        $clearing = ClearingHouse::whereId($clearing_id)->first();

        return !is_null($clearing) ? $clearing : null;
    }
}
