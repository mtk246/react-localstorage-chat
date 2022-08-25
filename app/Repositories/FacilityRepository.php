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
                "code"             => generateNewCode("FA", 5, date("Y"), Facility::class, "code"),
                "name"             => $data["name"],
                "npi"              => $data["npi"],
                "facility_type_id" => $data["facility_type_id"],
                "company_id"       => $data["company_id"],
            ]);


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
            $bC = auth()->user()->billing_company_id ?? null;
            if (!$bC) {
                return $facility->refresh()->load("nicknames", "company");
            } else {
                return $facility->refresh()->load([
                    "nicknames" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    "company"
                ]);
            }
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
                "company",
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
                    "company",
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
            $facilities = Facility::where('company_id', $company_id)->with([
                "addresses",
                "contacts",
                "nicknames",
                "company",
                "facilityType"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        } else {
            $facilities = Facility::where('company_id', $company_id)
                ->whereHas("billingCompanies", function ($query) use ($bC) {
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
                    "company",
                    "facilityType"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        }

        return !is_null($facilities) ? $facilities : null;
    }

    public function getServerAllFacilities(Request $request) {
        $sortBy   = $request->sortBy ?? 'id';
        $sortDesc = $request->sortDesc ?? false;
        $page = $request->page ?? 1;
        $itemsPerPage = $request->itemsPerPage ?? 5;
        $search = $request->search ?? '';

        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $records = Facility::with([
                "addresses",
                "contacts",
                "nicknames",
                "company",
                "facilityType"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->paginate($itemsPerPage);
        } else {
            $records = Facility::whereHas("billingCompanies", function ($query) use ($bC) {
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
                    "company",
                    "facilityType"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->paginate($itemsPerPage);
        }

        return response()->json([
            'pagination'  => [
                'total'       => $records->total(),
                'currentPage' => $records->currentPage(),
                'perPage'     => $records->perPage(),
                'lastPage'    => $records->lastPage()
            ],
            'items' =>  $records->items()
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
                "company",
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
                "company",
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
                "facility_type_id" => $data["facility_type_id"],
                "company_id"       => $data["company_id"]
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

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
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
                return Facility::whereId($id)->with(["nicknames", "company"])->first();
            } else {
                return Facility::whereId($id)->with([
                    "nicknames" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    "company"
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
}
