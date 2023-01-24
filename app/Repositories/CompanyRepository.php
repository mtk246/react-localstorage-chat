<?php

namespace App\Repositories;

use App\Models\BillingCompany;
use App\Models\Company;
use App\Models\CompanyStatement;
use App\Models\ExceptionInsuranceCompany;
use App\Models\Address;
use App\Models\AddressType;
use App\Models\Contact;
use App\Models\EntityNickname;
use App\Models\EntityAbbreviation;
use App\Models\Taxonomy;
use App\Models\TypeCatalog;
use App\Models\PrivateNote;
use App\Models\PublicNote;
use Illuminate\Http\Request;
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
                "code"          => generateNewCode("CO", 5, date("Y"), Company::class, "code"),
                "name"          => $data["name"],
                "npi"           => $data["npi"],
                "ein"           => $data["ein"],
                "upin"          => $data["upin"] ?? null,
                "clia"          => $data["clia"] ?? null,
                "name_suffix_id" => $data["name_suffix_id"] ?? null
            ]);
            
            if (isset($data['taxonomies'])) {
                $tax_array = [];
                foreach ($data['taxonomies'] as $taxonomy) {
                    $tax = Taxonomy::updateOrCreate(["tax_id" => $taxonomy["tax_id"]], $taxonomy);
                    array_push($tax_array, $tax->id);
                }
                $company->taxonomies()->sync($tax_array);
            }
            
            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            /** Attach billing company */
            $company->billingCompanies()->attach($billingCompany->id ?? $billingCompany);

            if (isset($data['nickname'])) {
                EntityNickname::create([
                    'nickname'           => $data['nickname'],
                    'nicknamable_id'     => $company->id,
                    'nicknamable_type'   => Company::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ]);
            }

            if (isset($data['abbreviation'])) {
                EntityAbbreviation::create([
                    'abbreviation'       => $data['abbreviation'],
                    'abbreviable_id'     => $company->id,
                    'abbreviable_type'   => Company::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ]);
            }

            if (isset($data['address']['address'])) {
                $data["address"]["billing_company_id"] = $billingCompany->id ?? $billingCompany;
                $data["address"]["addressable_id"]     = $company->id;
                $data["address"]["addressable_type"]   = Company::class;
                Address::create($data["address"]);
            }

            if (isset($data['payment_address']['address'])) {
                $addressType = AddressType::where('name', 'Other')->first();
                $data["address"]["address_type_id"]    = $addressType->id ?? null;
                $data["address"]["billing_company_id"] = $billingCompany->id ?? $billingCompany;
                $data["address"]["addressable_id"]     = $company->id;
                $data["address"]["addressable_type"]   = Company::class;
                Address::create($data["address"]);
            }

            if (isset($data["contact"]["email"])) {
                $data["contact"]["billing_company_id"] = $billingCompany->id ?? $billingCompany;
                $data["contact"]["contactable_id"]     = $company->id;
                $data["contact"]["contactable_type"]   = Company::class;
                Contact::create($data["contact"]);
            }

            if (isset($data['statements'])) {
                foreach ($data['statements'] as $statement) {
                    if (isset($statement["name"])) {
                        CompanyStatement::create([
                            "name"               => $statement["name"],
                            "start_date"         => $statement["start_date"] ?? null,
                            "end_date"           => $statement["end_date"] ?? null,
                            "date"               => $statement["date"] ?? null,
                            "rule_id"            => $statement["rule_id"] ?? null,
                            "when_id"            => $statement["when_id"] ?? null,
                            "apply_to_id"        => $statement["apply_to_id"] ?? null,
                            "company_id"         => $company->id,
                            "billing_company_id" => $billingCompany->id ?? $billingCompany
                        ]);
                    }
                    
                }
            }
            if (isset($data['exception_insurance_companies'])) {
                foreach ($data['exception_insurance_companies'] as $exceptionIC) {
                    ExceptionInsuranceCompany::create([
                        "company_id"           => $company->id,
                        "billing_company_id"   => $billingCompany->id ?? $billingCompany,
                        "insurance_company_id" => $exceptionIC
                    ]);
                }
            }

            if (isset($data['private_note'])) {
                PrivateNote::create([
                    'publishable_type'   => Company::class,
                    'publishable_id'     => $company->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'note'               => $data['private_note']
                ]);
            }

            if (isset($data['public_note'])) {
                PublicNote::create([
                    'publishable_type'   => Company::class,
                    'publishable_id'     => $company->id,
                    'note'               => $data['public_note']
                ]);
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

    public function getListStatementRules() {
        try {
            return getList(TypeCatalog::class, ['description'], ['relationship' => 'type', 'where' => ['description' => 'Statement rule']], null);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListStatementWhen() {
        try {
            return getList(TypeCatalog::class, ['description'], ['relationship' => 'type', 'where' => ['description' => 'Statement when']], null);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListStatementApplyTo() {
        try {
            return getList(TypeCatalog::class, ['description'], ['relationship' => 'type', 'where' => ['description' => 'Statement apply to']], null);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListNameSuffix() {
        try {
            return getList(TypeCatalog::class, ['description'], ['relationship' => 'type', 'where' => ['description' => 'Name suffix']], null);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListBillingCompanies(Request $request) {
        try {
            $companyId = $request->company_id ?? null;
            $edit = $request->edit ?? 'false';

            if (is_null($companyId)) {
                return getList(BillingCompany::class, 'name', ['status' => true]);
            } else {
                $ids = [];
                $billingCompanies = Company::find($companyId)->billingCompanies;
                foreach ($billingCompanies as $field) {
                    array_push($ids, $field->id);
                }
                if ($edit == 'true') {
                    return getList(BillingCompany::class, 'name', ['where' => ['status' => true], 'exists' => 'companies', 'whereHas' => ['relationship' => 'companies', 'where' => ['company_id' => $companyId]]]);
                } else {
                    return getList(BillingCompany::class, 'name', ['where' => ['status' => true], 'not_exists' => 'companies', 'orWhereHas' => ['relationship' => 'companies', 'where' => ['billing_company_id', $ids]]]);
                }
            }
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

    public function getServerAllCompanies(Request $request) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = Company::with([
                "addresses",
                "contacts",
                "nicknames",
                "billingCompanies"
            ]);
        } else {
            $data = Company::whereHas("billingCompanies", function ($query) use ($bC) {
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
                "billingCompanies" => function ($query) use ($bC) {
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
                    BillingCompany::select('name')->whereColumn('billing_companies.id', 'company.billing_company_id'), (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
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

    /**
     * @param int $id
     * @return Company|Builder|Model|object|null
     */
    public function getOneCompany(int $id) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $company = Company::whereId($id)->with([
                "taxonomies",
                "nameSuffix",
                "addresses",
                "contacts",
                "nicknames",
                "facilities",
                "companyStatements",
                "exceptionInsuranceCompanies",
                "billingCompanies",
                "publicNote",
                "privateNotes"
            ])->first();
        } else {
            $company = Company::whereId($id)->with([
                "taxonomies",
                "nameSuffix",
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
                "billingCompanies" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "exceptionInsuranceCompanies" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "companyStatements" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                "publicNote",
                "privateNotes" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                }
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

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"];
                $company->load([
                    "companyStatements" => function ($query) use ($billingCompany) {
                        $query->where("billing_company_id", $billingCompany);
                    },
                    "exceptionInsuranceCompanies" => function ($query) use ($billingCompany) {
                        $query->where("billing_company_id", $billingCompany);
                    },
                ]);
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
                $company->load(["companyStatements", "exceptionInsuranceCompanies"]);
            }
            
            /** Attach billing company */
            if (is_null($company->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $company->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
            } else {
                $company->billingCompanies()->updateExistingPivot($billingCompany->id ?? $billingCompany, [
                    'status' => true,
                ]);
            }

            $company->update([
                "ein"           => $data["ein"],
                "upin"          => $data["upin"] ?? null,
                "clia"          => $data["clia"] ?? null,
                "name_suffix_id" => $data["name_suffix_id"] ?? null
            ]);

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

            if (isset($data['nickname'])) {
                EntityNickname::updateOrCreate([
                    'nicknamable_id'     => $company->id,
                    'nicknamable_type'   => Company::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'nickname'           => $data['nickname'],
                ]);
            }

            if (isset($data['abbreviation'])) {
                EntityAbbreviation::updateOrCreate([
                    'abbreviable_id'     => $company->id,
                    'abbreviable_type'   => Company::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'abbreviation'           => $data['abbreviation'],
                ]);
            }

            if (isset($data['contact'])) {
                Contact::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                    "contactable_id"     => $company->id,
                    "contactable_type"   => Company::class
                ], $data['contact']);
            }

            if (isset($data['address']['address'])) {
                Address::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                    "addressable_id"     => $company->id,
                    "addressable_type"   => Company::class
                ], $data["address"]);
            }

            if (isset($data['payment_address']['address'])) {
                Address::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                    "addressable_id"     => $company->id,
                    "addressable_type"   => Company::class
                ], $data["address"]);
            }

            if (isset($data['statements'])) {
                foreach ($company->companyStatement as $statementDB) {
                    $find = false;
                    foreach ($data['statements'] as $statement) {
                        if ($statement['name'] == $statementDB->name) {
                            $find = true;
                        }
                    }
                    if ($find == false) {
                        $statementDB->delete();
                    }
                }

                foreach ($data['statements'] as $statement) {
                    if (isset($statement["name"])) {
                        CompanyStatement::updateOrCreate([
                            "name"               => $statement["name"],
                            "company_id"         => $company->id,
                            "billing_company_id" => $billingCompany->id ?? $billingCompany
                        ],
                        [
                            "start_date"         => $statement["start_date"] ?? null,
                            "end_date"           => $statement["end_date"] ?? null,
                            "date"               => $statement["date"] ?? null,
                            "rule_id"            => $statement["rule_id"] ?? null,
                            "when_id"            => $statement["when_id"] ?? null,
                            "apply_to_id"        => $statement["apply_to_id"] ?? null
                        ]);
                    }
                    
                }
            }
            if (isset($data['exception_insurance_companies'])) {
                foreach ($company->exceptionInsuranceCompany as $exceptionICDB) {
                    $find = false;
                    foreach ($data['exception_insurance_companies'] as $exceptionIC) {
                        if ($exceptionIC == $exceptionICDB->id) {
                            $find = true;
                        }
                    }
                    if ($find == false) {
                        $exceptionICDB->delete();
                    }
                }


                foreach ($data['exception_insurance_companies'] as $exceptionIC) {
                    ExceptionInsuranceCompany::updateOrCreate([
                        "company_id"           => $company->id,
                        "billing_company_id"   => $billingCompany->id ?? $billingCompany,
                        "insurance_company_id" => $exceptionIC
                    ],[]);
                }
            }

            if (isset($data['private_note'])) {
                PrivateNote::updateOrCreate([
                    'publishable_type'   => Company::class,
                    'publishable_id'     => $company->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'note'               => $data['private_note']
                ]);
            }

            if (isset($data['public_note'])) {
                PublicNote::updateOrCreate([
                    'publishable_type'   => Company::class,
                    'publishable_id'     => $company->id,
                ], [
                    'note'               => $data['public_note']
                ]);
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
            "nameSuffix",
            "publicNote"
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
