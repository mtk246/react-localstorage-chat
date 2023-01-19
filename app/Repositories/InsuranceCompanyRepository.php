<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\Contact;
use App\Models\EntityNickname;
use App\Models\InsuranceCompany;
use App\Models\TypeCatalog;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class InsuranceCompanyRepository
{
    /**
     * @param array $data
     * @return null
     */
    public function createInsurance(array $data) {
        try {
            DB::beginTransaction();
            $insurance = InsuranceCompany::create([
                "code"           => generateNewCode("IC", 5, date("Y"), InsuranceCompany::class, "code"),
                "name"           => $data["insurance"]["name"],
                "naic"           => $data["insurance"]["naic"] ?? '',
                "file_method_id" => $data["insurance"]["file_method"]
            ]);

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            /** Attach billing company */
            $insurance->billingCompanies()->attach($billingCompany->id ?? $billingCompany);

            if (isset($data['insurance']['nickname'])) {
                EntityNickname::create([
                    'nickname'           => $data['insurance']['nickname'],
                    'nicknamable_id'     => $insurance->id,
                    'nicknamable_type'   => InsuranceCompany::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ]);
            }

            if (isset($data['address']['address'])) {
                $data["address"]["billing_company_id"] = $billingCompany->id ?? $billingCompany;
                $data["address"]["addressable_id"]     = $insurance->id;
                $data["address"]["addressable_type"]   = InsuranceCompany::class;
                Address::create($data["address"]);
            }
            if (isset($data["contact"]["email"])) {
                $data["contact"]["billing_company_id"] = $billingCompany->id ?? $billingCompany;
                $data["contact"]["contactable_id"]     = $insurance->id;
                $data["contact"]["contactable_type"]   = InsuranceCompany::class;
                Contact::create($data["contact"]);
            }
            DB::commit();
            return $insurance;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllInsurance() {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $insuranceCompanies = InsuranceCompany::with([
                "addresses",
                "contacts",
                "nicknames"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        } else {
            $insuranceCompanies = InsuranceCompany::whereHas("billingCompanies", function ($query) use ($bC) {
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
                    }
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        }

        return !is_null($insuranceCompanies) ? $insuranceCompanies : null;
    }

    public function getServerAllInsurance(Request $request) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = InsuranceCompany::with([
                "addresses",
                "contacts",
                "nicknames",
                "abbreviations"

            ]);
        } else {
            $data = InsuranceCompany::whereHas("billingCompanies", function ($query) use ($bC) {
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
                    "abbreviations" => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    }
            ]);
        }
        
        if (!empty($request->query('query')) && $request->query('query')!=="{}") {
            $data = $data->search($request->query('query'));
        }
        
        if ($request->sortBy) {
            if (str_contains($request->sortBy, 'billingcompany')) {
                $data = $data->orderBy(
                    BillingCompany::select('name')->whereColumn('billing_companies.id', 'insurance_companies.billing_company_id'), (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } /**elseif (str_contains($request->sortBy, 'email')) {
                $data = $data->orderBy(
                    Contact::select('email')->whereColumn('contats.id', 'companies.billing_company_id'), (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } */else {
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

    public function getOneInsurance(int $id) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $insurance = InsuranceCompany::whereId($id)->with([
                "addresses",
                "contacts",
                "nicknames",
                "abbreviations",
                "billingCompanies",
                "billingIncompleteReasons",
                "appealReasons"
            ])->first();
        } else {
            $insurance = InsuranceCompany::whereId($id)->with([
                "addresses" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "contacts" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "nicknames" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "abbreviations" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "billingIncompleteReasons" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "appealReasons" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "billingCompanies",
            ])->first();
        }

        return !is_null($insurance) ? $insurance : null;
    }


    public function getByPayer(string $payer) {
        $insurance = InsuranceCompany::wherePayerId($payer)->first();
        return !is_null($insurance) ? $insurance : null;
    }

    public function getList() {
        return getList(InsuranceCompany::class);
    }

    public function getListBillingCompanies(Request $request) {
        $insuranceCompanyId = $request->insurance_company_id ?? null;
        $edit = $request->edit ?? false;

        if (is_null($insuranceCompanyId)) {
            return getList(BillingCompany::class, 'name', ['status' => true]);
        } else {
            if ($edit == true) {
                return getList(BillingCompany::class, 'name', ['where' => ['status' => true], 'exists' => 'insuranceCompanies', 'whereHas' => ['relationship' => 'insuranceCompanies', 'where' => ['insurance_company_id' => $insuranceCompanyId]]]);
            } else {
                return getList(BillingCompany::class, 'name', ['where' => ['status' => true], 'not_exists' => 'insuranceCompanies', 'whereHas' => ['relationship' => 'insuranceCompanies', 'where' => ['insurance_company_id' => $insuranceCompanyId]]]);
            }
        }
    }

    public function getListFileMethods() {
        try {
            return getList(TypeCatalog::class, ['code', '-', 'description'], ['relationship' => 'type', 'where' => ['description' => 'File method']]);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListFromTheDate() {
        try {
            return getList(TypeCatalog::class, ['description'], ['relationship' => 'type', 'where' => ['description' => 'From']]);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListBillingIncompleteReasons() {
        try {
            return getList(TypeCatalog::class, ['code', '-', 'description'], ['relationship' => 'type', 'where' => ['description' => 'Billing incomplete reasons']]);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListAppealReasons() {
        try {
            return getList(TypeCatalog::class, ['code', '-', 'description'], ['relationship' => 'type', 'where' => ['description' => 'Appeal reasons']], null);
        } catch (\Exception $e) {
            return [];
        }
    }


    /**
     * @param string $name
     * @return mixed
     */
    public function searchByName(string $name) {
        return InsuranceCompany::where("name","ILIKE","%${name}%")
            ->with([
                "addresses",
                "contacts",
                "billingCompanies"
            ])->get();
    }

    public function changeStatus(bool $status, int $id) {
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;
        
        $insuranceCompany = InsuranceCompany::find($id);
        if (is_null($insuranceCompany->billingCompanies()->find($billingCompany->id))) {
            $insuranceCompany->billingCompanies()->attach($billingCompany->id);
            return $insuranceCompany;
        } else {
            return $insuranceCompany->billingCompanies()->updateExistingPivot($billingCompany->id, [
                'status' => $status,
            ]);
        }
    }

    public function updateInsurance(array $data, int $id) {
        try {
            DB::beginTransaction();
            $insurance = InsuranceCompany::find($id);

            $insurance->update([
                "name"        => $data["insurance"]["name"],
                "naic"        => $data["insurance"]["naic"],
                "file_method" => $data["insurance"]["file_method"]
            ]);

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            /** Attach billing company */
            if (is_null($insurance->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $insurance->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
            } else {
                $insurance->billingCompanies()->updateExistingPivot($billingCompany->id ?? $billingCompany, [
                    'status' => true,
                ]);
            }

            if (isset($data['insurance']['nickname'])) {
                EntityNickname::updateOrCreate([
                    'nicknamable_id'     => $insurance->id,
                    'nicknamable_type'   => InsuranceCompany::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'nickname'           => $data['insurance']['nickname'],
                ]);
            }

            if (isset($data['address']['address'])) {
                Address::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                    "addressable_id"     => $insurance->id,
                    "addressable_type"   => InsuranceCompany::class,
                ],
                $data["address"]);
            }
            if (isset($data["contact"]["email"])) {
                Contact::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                    "contactable_id"     => $insurance->id,
                    "contactable_type"   => InsuranceCompany::class,
                ], $data["contact"]);
            }
            DB::commit();
            return $insurance;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param  int $id
     * @return InsuranceCompany|Builder|Model|object|null
     */
    public function addToBillingCompany(int $id) {
        $insuranceCompany = InsuranceCompany::find($id);
        if (is_null($insuranceCompany)) return null;
        
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;
        
        if (is_null($insuranceCompany->billingCompanies()->find($billingCompany->id))) {
            $insuranceCompany->billingCompanies()->attach($billingCompany->id);
        }
        return $insuranceCompany;
    }
}
