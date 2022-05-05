<?php

namespace App\Repositories;

use App\Models\BillingCompany;
use App\Models\Company;
use App\Models\Address;
use App\Models\Contact;
use App\Models\EntityNickname;
use App\Models\Taxonomy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CompanyRepository
{
    /**
     * @param array $data
     * @return Company|Model
     */
    public function createCompany(array $data) {
        try {
            DB::beginTransaction();
            $company = Company::create([
                "code" => generateNewCode("CO", 5, date("Y"), Company::class, "code"),
                "name" => $data["name"],
                "npi"  => $data["npi"],
            ]);
            
            if (isset($data['taxonomies'])) {
                $tax_array = [];
                foreach ($data['taxonomies'] as $taxonomy) {
                    $tax = Taxonomy::updateOrCreate(["tax_id" => $taxonomy["tax_id"]], $taxonomy);
                    array_push($tax_array, $tax->id);
                }
                $company->taxonomies()->sync($tax_array);
            }
            $this->changeStatus(true, $company->id);
            $billingCompany = auth()->user()->billingCompanies->first();

            if (isset($data['nickname'])) {
                EntityNickname::create([
                    'nickname'           => $data['nickname'],
                    'nicknamable_id'     => $company->id,
                    'nicknamable_type'   => Company::class,
                    'billing_company_id' => $billingCompany->id ?? null,
                ]);
            }

            if (isset($data['address']['address'])) {
                $data["address"]["billing_company_id"] = $billingCompany->id ?? null;
                $data["address"]["addressable_id"]     = $company->id;
                $data["address"]["addressable_type"]   = Company::class;
                Address::create($data["address"]);
            }
            if (isset($data["contact"]["email"])) {
                $data["contact"]["billing_company_id"] = $billingCompany->id ?? null;
                $data["contact"]["contactable_id"]     = $company->id;
                $data["contact"]["contactable_type"]   = Company::class;
                Contact::create($data["contact"]);
            }

            DB::commit();
            return $company;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    
    public function getListCompanies($id = null) {
        try {
            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $id;
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }
            return getList(Company::class, ['name'], ['relationship' => 'billingCompanies', 'where' => ['billing_company_id' => $billingCompany->id ?? $billingCompany]]);
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @return Company[]|Collection
     */
    public function getAllCompanies() {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $companies = Company::with([
                "addresses",
                "contacts",
                "nicknames"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        } else {
            $companies = Company::whereHas("billingCompanies", function ($query) use ($bC) {
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
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        }
        
        return is_null($companies) ? null : $companies;
    }

    /**
     * @param int $id
     * @return Company|Builder|Model|object|null
     */
    public function getOneCompany(int $id) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $company = Company::whereId($id)->with([
                "taxonomies",
                "addresses",
                "contacts",
                "nicknames",
                "facilities",
                "billingCompanies"
            ])->first();
        } else {
            $company = Company::whereId($id)->with([
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
                "facilities",
                "billingCompanies"
            ])->first();
        }

        return !is_null($company) ? $company : null;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Company|Builder|Model|object|null
     */
    public function updateCompany(array $data, int $id) {
        try {
            DB::beginTransaction();
            $company = Company::find($id);

            $company->update([
                "name"       => $data["name"],
                "npi"        => $data["npi"]
            ]);
            $this->changeStatus(true, $company->id);

            if (isset($data['taxonomies'])) {
                $tax_array = [];
                foreach ($data['taxonomies'] as $taxonomy) {
                    $tax = Taxonomy::updateOrCreate([
                        "tax_id" => $taxonomy["tax_id"]
                    ], $taxonomy);
                    array_push($tax_array, $tax->id);
                }
                $company->taxonomies()->sync($tax_array);
            }
            $billingCompany = auth()->user()->billingCompanies->first();

            if (isset($data['nickname'])) {
                EntityNickname::updateOrCreate([
                    'nicknamable_id'     => $company->id,
                    'nicknamable_type'   => Company::class,
                    'billing_company_id' => $billingCompany->id ?? null,
                ], [
                    'nickname'           => $data['nickname'],
                ]);
            }

            if (isset($data['contact'])) {
                Contact::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? null,
                    "contactable_id"     => $company->id,
                    "contactable_type"   => Company::class
                ], $data['contact']);
            }

            if (isset($data['address'])) {
                Address::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? null,
                    "addressable_id"     => $company->id,
                    "addressable_type"   => Company::class
                ], $data["address"]);
            }

            DB::commit();
            return Company::whereId($id)->first();
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param string $email
     * @return Company|Builder|Model|object|null
     */
    public function getOneByEmail(string $email) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $company = Company::whereEmail($email)->with([
                "taxonomies",
                "addresses",
                "contacts",
                "facilities",
                "billingCompanies"
            ])->first();
        } else {
            $company = Company::whereEmail($email)->with([
                "taxonomies",
                "addresses" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "contacts" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "facilities",
                "billingCompanies"
            ])->first();
        }
        return !is_null($company) ? $company : null;
    }

    /**
     * @param string $name
     * @return Company[]|Builder[]|Collection
     */
    public function getByName(string $name) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $company = Company::whereEmail($email)->with([
                "taxonomies",
                "addresses",
                "contacts",
                "facilities",
                "billingCompanies"
            ])->first();
        } else {
            $company = Company::where("name", "ILIKE", "%${name}%")->with([
                "taxonomies",
                "addresses" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "contacts" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "facilities",
                "billingCompanies"
            ])->first();
        }
        return !is_null($company) ? $company : null;
    }

    /**
     * @param string $npi
     * @return Company|Builder|Collection
     */
    public function getOneByNpi(string $npi) {
        $company = Company::whereNpi($npi)->with([
            "taxonomies",
            "addresses",
            "contacts",
            "facilities",
            "billingCompanies"
        ])->first();
        return !is_null($company) ? $company : null;
    }

    /**
     * @param int $status
     * @param int $id
     * @return bool|int
     */
    public function changeStatus(bool $status, int $id) {
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;
        
        $company = Company::find($id);
        if (is_null($company->billingCompanies()->find($billingCompany->id))) {
            $company->billingCompanies()->attach($billingCompany->id);
            return $company;
        } else {
            return $company->billingCompanies()->updateExistingPivot($billingCompany->id, [
                'status' => $status,
            ]);
        }
    }

    /**
     * @param  int $id
     * @return Company|Builder|Model|object|null
     */
    public function addToBillingCompany(int $id) {
        $company = Company::find($id);
        if (is_null($company)) return null;

        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;

        if (is_null($company->billingCompanies()->find($billingCompany->id))) {
            $company->billingCompanies()->attach($billingCompany->id);
        }
        return $company;
    }
}
