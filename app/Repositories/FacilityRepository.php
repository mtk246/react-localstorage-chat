<?php

namespace App\Repositories;

use App\Models\BillingCompany;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Facility;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FacilityRepository
{
    /**
     * @param array $data
     * @return Facility|Model
     */
    public function create(array $data) {
        $facility = Facility::create($data["facility"]);
        $this->changeStatus(true, $facility->id);

        $data["contact"]["facility_id"] = $facility->id;
        $data["address"]["facility_id"] = $facility->id;

        Address::create($data["address"]);
        Contact::create($data["contact"]);

        return $facility;
    }

    /**
     * @return Facility[]|Collection
     */
    public function getAllFacilities() {
        return Facility::with([
            "address",
            "contact"
        ])->get();
    }

    /**
     * @param int $id
     * @return Facility|Builder|Model|object|null
     */
    public function getOneFacility(int $id) {
        $facility = Facility::whereId($id)->with([
            "address",
            "contact",
            "company"
        ])->first();

        return !is_null($facility) ? $facility : null;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Facility|Builder|Model|object|null
     */
    public function updateFacility(array $data, int $id) {
        if (isset($data["facility"])) {
            $facility = Facility::whereId($id)->first();
            $facility->update($data['facility']);

            if (isset($data['address'])) {
                $address = Address::updateOrCreate([
                    'facility_id' => $facility->id
                ], $data["address"]);
            }

            if (isset($data['contact'])) {
                $contact = Contact::updateOrCreate([
                    'facility_id' => $facility->id
                ], $data["contact"]);
            }
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
    public function getByName(string $name) {
        return Facility::where("name","ilike","%${name}%")->get();
    }

    /**
     * @param bool $status
     * @param int $id
     * @return bool|int
     */
    public function changeStatus(bool $status, int $id) {
        $billingCompany = auth()->user()->billingCompanyUser->first();
        if (is_null($billingCompany)) return null;
        
        $facility = Facility::find($id);
        if (is_null($facility->billingCompanies()->find($billingCompany->id))) {
            return $facility->billingCompanies()->attach($billingCompany->id);
        } else {
            return $facility->billingCompanies()->updateExistingPivot($billingCompany->id, [
                'status' => $status,
            ]);
        }
    }

    /**
     * @param  int $id
     * @return Facility|Builder|Model|object|null
     */
    public function addToBillingCompany(int $id) {
        $facility = Facility::find($id);
        if (is_null($facility)) return null;
        
        $billingCompany = auth()->user()->billingCompanyUser->first();
        if (is_null($billingCompany)) return null;
        
        if (is_null($facility->billingCompanies()->find($billingCompany->id))) {
            $facility->billingCompanies()->attach($billingCompany->id);
        }
        return $facility;
    }
}
