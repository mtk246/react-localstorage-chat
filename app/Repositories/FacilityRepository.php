<?php

namespace App\Repositories;

use App\Models\BillingCompany;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Taxonomy;
use App\Models\Facility;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FacilityRepository
{
    /**
     * @param array $data
     * @return Facility|Model
     */
    public function create(array $data) {
        try {
            DB::beginTransaction();
            $facility = Facility::create([
                "code"       => generateNewCode("FA", 5, date("Y"), Facility::class, "code"),
                "name"       => $data["name"],
                "npi"        => $data["npi"],
                "type"       => $data["type"],
                "company_id" => $data["company_id"],
            ]);


            if (isset($data['taxonomies'])) {
                $tax_array = [];
                foreach ($data['taxonomies'] as $taxonomy) {
                    $tax = Taxonomy::updateOrCreate(["tax_id" => $taxonomy["tax_id"]], $taxonomy);
                    array_push($tax_array, $tax->id);
                }
                $facility->taxonomies()->sync($tax_array);
            }
            $this->changeStatus(true, $facility->id);
            $billingCompany = auth()->user()->billingCompanies->first();

            if (isset($data['address']['address'])) {
                $data["address"]["billing_company_id"] = $billingCompany->id ?? null;
                $data["address"]["addressable_id"]     = $facility->id;
                $data["address"]["addressable_type"]   = Facility::class;
                Address::create($data["address"]);
            }
            if (isset($data["contact"]["email"])) {
                $data["contact"]["billing_company_id"] = $billingCompany->id ?? null;
                $data["contact"]["contactable_id"]     = $facility->id;
                $data["contact"]["contactable_type"]   = Facility::class;
                Contact::create($data["contact"]);
            }

            DB::commit();
            return $facility;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @return Facility[]|Collection
     */
    public function getAllFacilities() {
        return Facility::with([
            "addresses",
            "contacts"
        ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
    }

    /**
     * @param int $id
     * @return Facility|Builder|Model|object|null
     */
    public function getOneFacility(int $id) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $facility = Facility::whereId($id)->with([
                "taxonomies",
                "addresses",
                "contacts",
                "company",
                "billingCompanies"
            ])->first();
        } else {
            $facility = Facility::whereId($id)->with([
                "taxonomies",
                "addresses" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "contacts" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "company",
                "billingCompanies"
            ])->first();
        }

        return !is_null($facility) ? $facility : null;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Facility|Builder|Model|object|null
     */
    public function updateFacility(array $data, int $id) {
        try {
            DB::beginTransaction();
            $facility = Facility::find($id);

            $facility->update([
                "name"       => $data["name"],
                "npi"        => $data["npi"],
                "type"       => $data["type"],
                "company_id" => $data["company_id"]
            ]);

            if (isset($data['taxonomies'])) {
                $tax_array = [];
                foreach ($data['taxonomies'] as $taxonomy) {
                    $tax = Taxonomy::updateOrCreate([
                        "tax_id" => $taxonomy["tax_id"]
                    ], $taxonomy);
                    array_push($tax_array, $tax->id);
                }
                $facility->taxonomies()->sync($tax_array);
            }

            $billingCompany = auth()->user()->billingCompanies->first();

            if (isset($data['contact'])) {
                Contact::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? '',
                    "contactable_id"     => $facility->id,
                    "contactable_type"   => Facility::class
                ], $data['contact']);
            }

            if (isset($data['address'])) {
                Address::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? '',
                    "addressable_id"     => $facility->id,
                    "addressable_type"   => Facility::class
                ], $data["address"]);
            }

            DB::commit();
            return Facility::whereId($id)->first();
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
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
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;
        
        $facility = Facility::find($id);
        if (is_null($facility->billingCompanies()->find($billingCompany->id))) {
            $facility->billingCompanies()->attach($billingCompany->id);
            return $facility;
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
        
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;
        
        if (is_null($facility->billingCompanies()->find($billingCompany->id))) {
            $facility->billingCompanies()->attach($billingCompany->id);
        }
        return $facility;
    }
}
