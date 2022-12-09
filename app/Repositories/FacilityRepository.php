<?php

namespace App\Repositories;

use App\Models\BillingCompany;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Taxonomy;
use App\Models\Facility;
use App\Models\FacilityType;
use App\Models\EntityNickname;
use Illuminate\Http\Request;
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
                "code"             => generateNewCode(getPrefix($data["name"]), 5, date("y"), Facility::class, "code"),
                "name"             => $data["name"],
                "npi"              => $data["npi"],
                "facility_type_id" => $data["facility_type_id"]
            ]);

            if (isset($data['companies'])) {
                $facility->companies()->sync($data['companies']);
            };

            if (isset($data['taxonomies'])) {
                $tax_array = [];
                foreach ($data['taxonomies'] as $taxonomy) {
                    $tax = Taxonomy::updateOrCreate(["tax_id" => $taxonomy["tax_id"]], $taxonomy);
                    array_push($tax_array, $tax->id);
                }
                $facility->taxonomies()->sync($tax_array);
            }
            
            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            /** Attach billing company */
            $facility->billingCompanies()->attach($billingCompany->id ?? $billingCompany);

            if (isset($data['nickname'])) {
                EntityNickname::create([
                    'nickname'           => $data['nickname'],
                    'nicknamable_id'     => $facility->id,
                    'nicknamable_type'   => Facility::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ]);
            }

            if (isset($data['address']['address'])) {
                $data["address"]["billing_company_id"] = $billingCompany->id ?? $billingCompany;
                $data["address"]["addressable_id"]     = $facility->id;
                $data["address"]["addressable_type"]   = Facility::class;
                Address::create($data["address"]);
            }
            if (isset($data["contact"]["email"])) {
                $data["contact"]["billing_company_id"] = $billingCompany->id ?? $billingCompany;
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
     * @return FacilityType[]|Collection
     */
    public function getAllFacilityTypes() {
        $records = FacilityType::all();
        /** Inicia la opción vacia por defecto */
        $options = [];
        foreach ($records as $rec) {
            $text = $rec->type;
            array_push($options, ['id' => $rec->id, 'name' => $text]);
        }
        return $options;
    }

    /**
     * @return Facility[]|Collection
     */
    public function getAllFacilities() {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $facilities = Facility::with([
                "addresses",
                "contacts",
                "nicknames",
                "companies",
                "facilityType"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        } else {
            $facilities = Facility::whereHas("billingCompanies", function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                })->with([
                    "addresses" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    "contacts" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    "nicknames" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    "companies",
                    "facilityType"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        }

        return !is_null($facilities) ? $facilities : null;
    }

    /**
     * @return Facility[]|Collection
     */
    public function getAllByCompany($company_id) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $facilities = Facility::with([
                "addresses",
                "contacts",
                "nicknames",
                "companies",
                "facilityType"
            ])->whereHas('companies', function ($query) use ($company_id) {
                $query->where('company_id', $company_id);
            })->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        } else {
            $facilities = Facility::with([
                    "addresses" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    "contacts" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    "nicknames" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    "companies",
                    "facilityType"
            ])->whereHas('companies', function ($query) use ($company_id) {
                $query->where('company_id', $company_id);
            })->whereHas("billingCompanies", function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                })->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        }

        return !is_null($facilities) ? $facilities : null;
    }

    public function getServerAllFacilities(Request $request) {

        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = Facility::with([
                "addresses",
                "contacts",
                "nicknames",
                "companies",
                "facilityType"
            ]);
        } else {
            $data = Facility::whereHas("billingCompanies", function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                })->with([
                    "addresses" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    "contacts" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    "nicknames" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    "companies",
                    "facilityType"
            ]);
        }
        
        if (!empty($request->query('query')) && $request->query('query')!=="{}") {
            $data = $data->search($request->query('query'));
        }
        
        if ($request->sortBy) {
            if (str_contains($request->sortBy, 'billingcompany')) {
                $data = $data->orderBy(
                    BillingCompany::select('name')->whereColumn('billing_companies.id', 'facilities.billing_company_id'), (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } else {
                $data = $data->orderBy($request->sortBy, (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            }
        } else {
            $data = $data->orderBy("created_at", "desc")->orderBy("id", "asc");
        }

        $data = $data->paginate($request->itemsPerPage ?? 5);

        return response()->json([
            'data'          => $data->items(),
            'numberOfPages' => $data->lastPage(),
            'count'         => $data->total()
        ], 200);
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
                "companies",
                "billingCompanies",
                "nicknames",
                "facilityType"
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
                "nicknames" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "companies",
                "facilityType",
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
                "name"             => $data["name"],
                "npi"              => $data["npi"],
                "facility_type_id" => $data["facility_type_id"]
            ]);

            if (isset($data['companies'])) {
                $facility->companies()->sync($data['companies']);
            };

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

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            /** Attach billing company */
            if (is_null($facility->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $facility->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
            } else {
                $facility->billingCompanies()->updateExistingPivot($billingCompany->id ?? $billingCompany, [
                    'status' => true,
                ]);
            }

            if (isset($data['nickname'])) {
                EntityNickname::updateOrCreate([
                    'nicknamable_id'     => $facility->id,
                    'nicknamable_type'   => Facility::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'nickname'           => $data['nickname'],
                ]);
            }

            if (isset($data['contact'])) {
                Contact::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                    "contactable_id"     => $facility->id,
                    "contactable_type"   => Facility::class
                ], $data['contact']);
            }

            if (isset($data['address'])) {
                Address::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                    "addressable_id"     => $facility->id,
                    "addressable_type"   => Facility::class
                ], $data["address"]);
            }

            DB::commit();
            $bC = auth()->user()->billing_company_id ?? null;
            if (!$bC) {
                return Facility::whereId($id)->with(["nicknames", "companies"])->first();
            } else {
                return Facility::whereId($id)->with([
                    "nicknames" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    "companies"
                ])->first();
            }
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
     * @param string $npi
     * @return Company|Builder|Collection
     */
    public function getOneByNpi(string $npi) {
        $facility = Facility::whereNpi($npi)->with([
            "addresses", "contacts", "billingCompanies"
        ])->first();

        return !is_null($facility) ? $facility : null;
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

    /**
     * @param  int $id
     * @return Facility|Builder|Model|object|null
     */
    public function addToCompany(int $facilityId, int $companyId) {
        
        $facility = Facility::find($facilityId);
        if (is_null($facility->companies()->find($companyId))) {
            $facility->companies()->attach($companyId);
            return $facility;
        } else {
            return $facility;
        }
    }

    /**
     * @param  int $id
     * @return Facility|Builder|Model|object|null
     */
    public function removeToCompany(int $facilityId, int $companyId) {
        
        $facility = Facility::find($facilityId);
        if (is_null($facility->companies()->find($companyId))) {
            return $facility;
        } else {
            $facility->companies()->detach($companyId);
            return $facility;
        }
    }
}
