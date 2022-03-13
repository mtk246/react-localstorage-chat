<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\BillingCompany;
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
    public function create(array $data) {
        $clearing = ClearingHouse::create([
            "code" => $data["code"],
            "name" => $data["name"],
        ]);
        $this->changeStatus(true, $clearing->id);

        $data["address"]["clearing_house_id"] = $clearing->id;
        $data["contact"]["clearing_house_id"] = $clearing->id;

        Address::create($data["address"]);
        Contact::create($data["contact"]);

        return $clearing;
    }

    /**
     * @return ClearingHouse[]|Collection
     */
    public function getAllClearingHouse() {
        return ClearingHouse::with([
            "address",
            "contact"
        ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
    }

    /**
     * @param int $clearing_id
     * @return ClearingHouse|Builder|Model|object|null
     */
    public function getOneClearingHouse(int $clearing_id) {
        $clearing = ClearingHouse::whereId($clearing_id)->with([
            "address",
            "contact"
        ])->first();

        return !is_null($clearing) ? $clearing : null;
    }

    public function updateClearingHouse(array $data, int $id) {
        $clearing = ClearingHouse::whereId($id)->first();

        $clearings = ClearingHouse::where("name",$data["clearing-house"]["name"])->get();

        if (isset($data['clearing-house'])) {
            if(count($clearings) == 0 && ($clearing->name != $data['clearing-house']['name'])){
                ClearingHouse::updateOrCreate(["id" => $id], $data['clearing-house']);
            }
        }

        if (isset($data['address'])) {
            $address = Address::whereClearingHouseId($id)->first();

            if (is_null($address)) {
                $data["address"]["clearing_house_id"] = $id;
                Address::create($data["address"]);
            } else {
                Address::whereClearingHouseId($id)->update($data["address"]);
            }

        }

        if (isset($data['contact'])) {
            $contact = Contact::whereClearingHouseId($id)->first();

            if (is_null($contact)) {
                $data["contact"]["clearing_house_id"] = $id;
                Contact::create($data["contact"]);
            } else {
                Contact::whereClearingHouseId($id)->update($data["contact"]);
            }
        }

        return ClearingHouse::whereId($id)->with([
            "address",
            "contact"
        ])->first();
    }

    public function getOneByName(string $name) {
        return ClearingHouse::with([
            "address",
            "contact"
        ])->where("name","ILIKE","%${name}%")->get();
    }

    public function changeStatus(bool $status, int $id) {
        $billingCompany = auth()->user()->billingCompanyUser->first();
        if (is_null($billingCompany)) return null;
        
        $clearingHouse = ClearingHouse::find($id);
        if (is_null($clearingHouse->billingCompanies()->find($billingCompany->id))) {
            $clearingHouse->billingCompanies()->attach($billingCompany->id);
            return $clearingHouse;
        } else {
            return $clearingHouse->billingCompanies()->updateExistingPivot($billingCompany->id, [
                'status' => $status,
            ]);
        }
    }

    /**
     * @param  int $id
     * @return ClearingHouse|Builder|Model|object|null
     */
    public function addToBillingCompany(int $id) {
        $clearingHouse = ClearingHouse::find($id);
        if (is_null($clearingHouse)) return null;
        
        $billingCompany = auth()->user()->billingCompanyUser->first();
        if (is_null($billingCompany)) return null;
        
        if (is_null($clearingHouse->billingCompanies()->find($billingCompany->id))) {
            $clearingHouse->billingCompanies()->attach($billingCompany->id);
        }
        return $clearingHouse;
    }
}
