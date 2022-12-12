<?php

namespace App\Repositories;

use App\Mail\GenerateNewPassword;
use App\Models\Address;
use App\Models\Contact;
use App\Models\HealthProfessional;
use App\Models\HealthProfessionalType;
use App\Models\CompanyHealthProfessionalType;
use App\Models\User;
use App\Models\Profile;
use App\Models\Taxonomy;
use App\Models\SocialMedia;
use App\Models\SocialNetwork;
use App\Models\BillingCompany;
use App\Models\PublicNote;
use App\Models\PrivateNote;
use App\Models\Company;
use App\Models\EntityNickname;
use App\Roles\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class DoctorRepository
{
    public function createDoctor(array $data)
    {
        try {
            \DB::beginTransaction();
            /** Create Profile */
            if (isset($data["profile"]["ssn"])) {
                $profile = Profile::updateOrCreate([
                    "first_name"    => $data["profile"]["first_name"],
                    "last_name"     => $data["profile"]["last_name"],
                    "date_of_birth" => $data["profile"]["date_of_birth"],
                    "ssn"           => $data["profile"]["ssn"]
                ], [
                    "ssn"           => $data["profile"]["ssn"],
                    "first_name"    => $data["profile"]["first_name"],
                    "middle_name"   => $data["profile"]["middle_name"] ?? '',
                    "last_name"     => $data["profile"]["last_name"],
                    "sex"           => $data["profile"]["sex"],
                    "date_of_birth" => $data["profile"]["date_of_birth"]
                ]);
            } else {
                $profile = Profile::updateOrCreate([
                    "first_name"    => $data["profile"]["first_name"],
                    "last_name"     => $data["profile"]["last_name"],
                    "date_of_birth" => $data["profile"]["date_of_birth"],
                ], [
                    "ssn"           => $data["profile"]["ssn"],
                    "first_name"    => $data["profile"]["first_name"],
                    "middle_name"   => $data["profile"]["middle_name"] ?? '',
                    "last_name"     => $data["profile"]["last_name"],
                    "sex"           => $data["profile"]["sex"],
                    "date_of_birth" => $data["profile"]["date_of_birth"]
                ]);
            }

            if (isset($data["profile"]["social_medias"])) {
                $socialMedias = $profile->socialMedias;
                /** Delete socialMedia */
                foreach ($socialMedias as $socialMedia) {
                    $validated = false;
                    $socialNetwork = $socialMedia->SocialNetwork;
                    if (isset($socialNetwork)) {
                        foreach ($data["profile"]["social_medias"] as $socialM) {
                            if ($socialM['name'] == $socialNetwork->name) {
                                $validated = true;
                                break;
                            }
                        }
                    }
                    if (!$validated) $socialMedia->delete();
                }

                /** update or create new social medias */
                foreach ($data["profile"]["social_medias"] as $socialMedia) {
                    $socialNetwork = SocialNetwork::whereName($socialMedia["name"])->first();
                    if (isset($socialNetwork)) {
                        SocialMedia::updateOrCreate([
                            "profile_id"        => $profile->id,
                            "social_network_id" => $socialNetwork->id
                        ], [
                            "link" => $socialMedia["link"]
                        ]);
                    }
                }
            }
            /** Create User */
            $user = User::create([
                "usercode"   => generateNewCode("US", 5, date("y"), User::class, "usercode"),
                "email"      => $data['email'],
                "userkey"    => encrypt(uniqid("", true)),
                "profile_id" => $profile->id
            ]);

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            /** Attach billing company */
            $user->billingCompanies()->sync($billingCompany->id ?? $billingCompany);
            
            if (isset($data['contact'])) {
                $data["contact"]["contactable_id"]     = $user->id;
                $data["contact"]["contactable_type"]   = User::class;
                $data["contact"]["billing_company_id"] = $billingCompany->id ?? $billingCompany;
                Contact::create($data["contact"]);
            }

            if (isset($data['address'])) {
                $data["address"]["addressable_id"]     = $user->id;
                $data["address"]["addressable_type"]   = User::class;
                $data["address"]["billing_company_id"] = $billingCompany->id ?? $billingCompany;
                Address::create($data["address"]);
            }
            if (($data["is_provider"] ?? false)) {
                if (isset($data["npi_company"])) {
                    $company = Company::where('npi', $data["npi_company"])->first();
                    if (!isset($company)) {
                        $company = Company::create([
                            "code" => generateNewCode(getPrefix($data["name_company"]), 5, date("y"), Company::class, "code"),
                            "name" => $data["name_company"],
                            "npi"  => $data["npi_company"],
                        ]);
                    }
                    if (isset($data['taxonomies_company'])) {
                        $tax_array = [];
                        foreach ($data['taxonomies_company'] as $taxonomy) {
                            $tax = Taxonomy::updateOrCreate(["tax_id" => $taxonomy["tax_id"]], $taxonomy);
                            array_push($tax_array, $tax->id);
                        }
                        $company->taxonomies()->sync($tax_array);
                    }
                    if (is_null($company->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                        $company->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
                    } else {
                        $company->billingCompanies()->updateExistingPivot($billingCompany->id ?? $billingCompany, [
                            'status' => true,
                        ]);
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
                } else {
                    $company = Company::where('npi', $data["npi"])->first();
                    if (!isset($company)) {
                        $company = Company::create([
                            "code" => generateNewCode(getPrefix($data["profile"]["first_name"] . ' ' . $data["profile"]["last_name"]), 5, date("y"), Company::class, "code"),
                            "name" => $data["profile"]["first_name"] . ' ' . $data["profile"]["last_name"],
                            "npi"  => $data["npi"],
                        ]);
                    }
                    if (isset($data['taxonomies'])) {
                        $tax_array = [];
                        foreach ($data['taxonomies'] as $taxonomy) {
                            $tax = Taxonomy::updateOrCreate(["tax_id" => $taxonomy["tax_id"]], $taxonomy);
                            array_push($tax_array, $tax->id);
                        }
                        $company->taxonomies()->sync($tax_array);
                    }
                    if (is_null($company->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                        $company->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
                    } else {
                        $company->billingCompanies()->updateExistingPivot($billingCompany->id ?? $billingCompany, [
                            'status' => true,
                        ]);
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
                }
            }
            $healthP = HealthProfessional::create([
                "code"                        => generateNewCode("HP", 5, date("y"), HealthProfessional::class, "code"),
                "npi"                         => $data["npi"],
                "health_professional_type_id" => $data["health_professional_type_id"],
                "is_provider"                 => $data["is_provider"] ?? false,
                "npi_company"                 => $data["npi_company"] ?? '',
                "company_id"                  => $company->id ?? $data["company_id"],
                "user_id"                     => $user->id
            ]);
            $auth = [];
            foreach ($data["authorization"] as $authorization) {
                if (is_numeric($authorization)) {
                    array_push($auth, $authorization);
                }
            }
            if (is_null($healthP->companies()->find($company->id ?? $data["company_id"]))) {
                $healthP->companies()->attach($company->id ?? $data["company_id"], [
                    'authorization' => $auth,
                ]);
            } else {
                $healthP->companies()->updateExistingPivot($company->id ?? $data["company_id"], [
                    'authorization' => $auth,
                ]);
            }

            if (isset($data['private_note'])) {
                PrivateNote::create([
                    'publishable_type'   => HealthProfessional::class,
                    'publishable_id'     => $healthP->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'note'               => $data['private_note']
                ]);
            }

            if (isset($data['public_note'])) {
                PublicNote::create([
                    'publishable_type'   => HealthProfessional::class,
                    'publishable_id'     => $healthP->id,
                    'note'               => $data['private_note']
                ]);
            }

            if (is_null($healthP->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $healthP->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
            } else {
                $healthP->billingCompanies()->updateExistingPivot(
                    $billingCompany->id ?? $billingCompany,
                    [
                        'status' => true
                    ]
                );
            }

            if (isset($data['taxonomies'])) {
                $tax_array = [];
                foreach ($data['taxonomies'] as $taxonomy) {
                    $tax = Taxonomy::updateOrCreate(["tax_id" => $taxonomy["tax_id"]], $taxonomy);
                    array_push($tax_array, $tax->id);
                }
                $healthP->taxonomies()->sync($tax_array);
            }

            if(!is_null($healthP) && !is_null($user)){
                $role = Role::whereSlug('healthprofessional')->first();
                $user->attachRole($role);

                $token = encrypt($user->id."@#@#$".$user->email);
                $user->token = $token;
                $user->save();

                Mail::to($user->email)->send(
                    new GenerateNewPassword(
                        $profile->first_name . ' ' . $profile->last_name,
                        $user->email,
                        \Crypt::decrypt($user->userkey),
                        env('URL_FRONT') . "/#/newCredentials?mcctoken=" . $token
                    )
                );
            } else {
                \DB::rollBack();
                return null;
            }

            \DB::commit();
            return $healthP;
        }catch (\Exception $e){
            \DB::rollBack();
            dd($e->getMessage());
        }
    }

    /**
     * @param array $data
     * @param int $id
     * @return Builder|Model|object|User|null
     */
    public function updateDoc(array $data, int $id)
    {
        try {
            \DB::beginTransaction();
            
            $healthP = HealthProfessional::find($id);
            $healthP->update([
                "npi"                         => $data["npi"],
                "health_professional_type_id" => $data["health_professional_type_id"],
                "is_provider"                 => $data["is_provider"] ?? false,
                "npi_company"                 => $data["npi_company"] ?? '',
                "company_id"                  => $data["company_id"] ?? null
            ]);

            if (isset($data['taxonomies'])) {
                $tax_array = [];
                foreach ($data['taxonomies'] as $taxonomy) {
                    $tax = Taxonomy::updateOrCreate([
                        "tax_id" => $taxonomy["tax_id"]
                    ], $taxonomy);
                    array_push($tax_array, $tax->id);
                }
                $healthP->taxonomies()->sync($tax_array);
            }

            /** Edit User */
            $user = $healthP->user;
            $user->update([
                "email" => $data['email'],
            ]);
            
            /** Edit Profile */
            $profile = $user->profile;

            $profile->update([
                "ssn"           => $data["profile"]["ssn"],
                "first_name"    => $data["profile"]["first_name"],
                "middle_name"   => $data["profile"]["middle_name"] ?? '',
                "last_name"     => $data["profile"]["last_name"],
                "sex"           => $data["profile"]["sex"],
                "date_of_birth" => $data["profile"]["date_of_birth"]
            ]);

            if (isset($data["profile"]["social_medias"])) {
                $socialMedias = $profile->socialMedias;
                /** Delete socialMedia */
                foreach ($socialMedias as $socialMedia) {
                    $validated = false;
                    $socialNetwork = $socialMedia->SocialNetwork;
                    if (isset($socialNetwork)) {
                        foreach ($data["profile"]["social_medias"] as $socialM) {
                            if ($socialM['name'] == $socialNetwork->name) {
                                $validated = true;
                                break;
                            }
                        }
                    }
                    if (!$validated) $socialMedia->delete();
                }

                /** update or create new social medias */
                foreach ($data["profile"]["social_medias"] as $socialMedia) {
                    $socialNetwork = SocialNetwork::whereName($socialMedia["name"])->first();
                    if (isset($socialNetwork)) {
                        SocialMedia::updateOrCreate([
                            "profile_id"        => $profile->id,
                            "social_network_id" => $socialNetwork->id
                        ], [
                            "link" => $socialMedia["link"]
                        ]);
                    }
                }
            }
            
            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            if (is_null($healthP->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $healthP->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
            } else {
                $healthP->billingCompanies()->updateExistingPivot(
                    $billingCompany->id ?? $billingCompany,
                    [
                        'status' => true
                    ]
                );
            }

            $user->billingCompanies()->sync($billingCompany->id ?? $billingCompany);

            if (isset($data['contact'])) {
                Contact::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                    "contactable_id"     => $user->id,
                    "contactable_type"   => User::class
                ], $data['contact']);
            }

            if (isset($data['address'])) {
                Address::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                    "addressable_id"     => $user->id,
                    "addressable_type"   => User::class
                ], $data["address"]);
            }

            if (isset($data['public_note'])) {
                /** PublicNote */
                PublicNote::updateOrCreate([
                    'publishable_type' => HealthProfessional::class,
                    'publishable_id'   => $healthP->id,
                ], [
                    'note'             => $data['public_note'],
                ]);
            }

            if (isset($data['private_note'])) {
                /** PrivateNote */
                PrivateNote::updateOrCreate([
                    'publishable_type' => HealthProfessional::class,
                    'publishable_id'   => $healthP->id,
                ], [
                    'note'             => $data['private_note'],
                ]);
            }

            if (($data["is_provider"] ?? false)) {
                if (isset($data["npi_company"])) {
                    $company = Company::where('npi', $data["npi_company"])->first();
                    if (!isset($company)) {
                        $company = Company::create([
                            "code" => generateNewCode(getPrefix($data["name_company"]), 5, date("y"), Company::class, "code"),
                            "name" => $data["name_company"],
                            "npi"  => $data["npi_company"],
                        ]);
                    }
                    if (isset($data['taxonomies_company'])) {
                        $tax_array = [];
                        foreach ($data['taxonomies_company'] as $taxonomy) {
                            $tax = Taxonomy::updateOrCreate(["tax_id" => $taxonomy["tax_id"]], $taxonomy);
                            array_push($tax_array, $tax->id);
                        }
                        $company->taxonomies()->sync($tax_array);
                    }
                    if (is_null($company->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                        $company->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
                    } else {
                        $company->billingCompanies()->updateExistingPivot($billingCompany->id ?? $billingCompany, [
                            'status' => true,
                        ]);
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
                } else {
                    $company = Company::where('npi', $data["npi"])->first();
                    if (!isset($company)) {
                        $company = Company::create([
                            "code" => generateNewCode(getPrefix($data["profile"]["first_name"] . ' ' . $data["profile"]["last_name"]), 5, date("y"), Company::class, "code"),
                            "name" => $data["profile"]["first_name"] . ' ' . $data["profile"]["last_name"],
                            "npi"  => $data["npi"],
                        ]);
                    }
                    if (isset($data['taxonomies'])) {
                        $tax_array = [];
                        foreach ($data['taxonomies'] as $taxonomy) {
                            $tax = Taxonomy::updateOrCreate(["tax_id" => $taxonomy["tax_id"]], $taxonomy);
                            array_push($tax_array, $tax->id);
                        }
                        $company->taxonomies()->sync($tax_array);
                    }
                    if (is_null($company->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                        $company->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
                    } else {
                        $company->billingCompanies()->updateExistingPivot($billingCompany->id ?? $billingCompany, [
                            'status' => true,
                        ]);
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
                }
            }
            $auth = [];
            foreach ($data["authorization"] as $authorization) {
                if (is_numeric($authorization)) {
                    array_push($auth, $authorization);
                }
            }
            if (is_null($healthP->companies()->find($company->id ?? $data["company_id"]))) {
                $healthP->companies()->attach($company->id ?? $data["company_id"], [
                    'authorization' => $auth,
                ]);
            } else {
                $healthP->companies()->updateExistingPivot($company->id ?? $data["company_id"], [
                    'authorization' => $auth,
                ]);
            }

            \DB::commit();
            return $healthP;
        }catch (\Exception $e){
            \DB::rollBack();
            dd($e->getMessage());
        }
    }

    /**
     * @return Collection|Doctor[]
     */
    public function getAllDoctors() {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $healthProfessionals = HealthProfessional::with([
                "user" => function ($query) {
                    $query->with([
                        "profile" => function ($query) {
                            $query->with('socialMedias');
                        },
                        "roles",
                        "addresses",
                        "contacts",
                        "billingCompanies"
                    ]);
                },
                "taxonomies",
                "companies" => function ($query) {
                    $query->with(["taxonomies", "nicknames"]);
                },
                "healthProfessionalType",
                "company"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        } else {
            $healthProfessionals = HealthProfessional::whereHas("billingCompanies", function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                })->with([
                "user" => function ($query) use ($bC) {
                    $query->with([
                        "profile" => function ($query) {
                            $query->with('socialMedias');
                        },
                        "roles",
                        "addresses" => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                        "contacts" => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                        "billingCompanies"
                    ]);
                },
                "taxonomies",
                "companies" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC)
                          ->with(["taxonomies", "nicknames"]);
                },
                "healthProfessionalType",
                "company"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        }
        return !is_null($healthProfessionals) ? $healthProfessionals : null;
    }

    public function getServerAllDoctors(Request $request) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = HealthProfessional::with([
                "user" => function ($query) {
                    $query->with([
                        "profile" => function ($query) {
                            $query->with('socialMedias');
                        },
                        "roles",
                        "addresses",
                        "contacts"
                    ]);
                },
                "taxonomies"
            ]);
        } else {
            $data = HealthProfessional::whereHas("billingCompanies", function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                })->with([
                "user" => function ($query) use ($bC) {
                    $query->with([
                        "profile" => function ($query) {
                            $query->with('socialMedias');
                        },
                        "roles",
                        "addresses" => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                        "contacts" => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                    ]);
                },
                "taxonomies"
            ]);
        }
        
        if (!empty($request->query('query')) && $request->query('query')!=="{}") {
            $data = $data->search($request->query('query'));
        }
        
        if ($request->sortBy) {
            if (str_contains($request->sortBy, 'billingcompany')) {
                $data = $data->orderBy(
                    BillingCompany::select('name')->whereColumn('billing_companies.id', 'health_professionals.billing_company_id'), (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
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
     * @return Doctor|Builder|Model|object|null
     */
    public function getOneDoctor(int $id) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $healthP = HealthProfessional::whereId($id)->with([
                "user" => function ($query) {
                    $query->with([
                        "profile" => function ($query) {
                            $query->with('socialMedias');
                        },
                        "roles",
                        "addresses",
                        "contacts",
                        "billingCompanies"
                    ]);
                },
                "taxonomies",
                "companies" => function ($query) {
                    $query->with(["taxonomies", "nicknames"]);
                },
                "healthProfessionalType",
                "company"
            ])->first();
        } else {
            $healthP = HealthProfessional::whereId($id)->with([
                "user" => function ($query) use ($bC) {
                    $query->with([
                        "profile" => function ($query) {
                            $query->with('socialMedias');
                        },
                        "roles",
                        "addresses" => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                        "contacts" => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                        "billingCompanies"
                    ]);
                },
                "taxonomies",
                "companies" => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC)
                          ->with(["taxonomies", "nicknames"]);
                },
                "healthProfessionalType",
                "company"
            ])->first();
        }
        return !is_null($healthP) ? $healthP : null;
    }

    /**
     * @param string $npi
     * @return Doctor|Builder|Model|object|null
     */
    public function getOneByNpi(string $npi){
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $healthP = HealthProfessional::whereNpi($npi)->with([
                "user" => function ($query) {
                    $query->with([
                        "profile" => function ($query) {
                            $query->with('socialMedias');
                        },
                        "roles",
                        "addresses",
                        "contacts",
                        "billingCompanies"
                    ]);
                },
                "taxonomies"
            ])->first();
        } else {
            $healthP = HealthProfessional::whereNpi($npi)->with([
                "user" => function ($query) {
                    $query->with([
                        "profile" => function ($query) {
                            $query->with('socialMedias');
                        },
                        "roles",
                        "addresses" => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                        "contacts" => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                        "billingCompanies"
                    ]);
                },
                "taxonomies"
            ])->first();
        }
        return !is_null($healthP) ? $healthP : null;
    }

    /**
     * @param bool $status
     * @param int $id
     * @return bool|int|null
     */
    public function changeStatus(bool $status, int $id) {
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;
        
        $healthP = HealthProfessional::find($id);
        if (is_null($healthP->billingCompanies()->find($billingCompany->id))) {
            $healthP->billingCompanies()->attach($billingCompany->id);
            return $healthP;
        } else {
            return $healthP->billingCompanies()->updateExistingPivot($billingCompany->id, [
                'status' => $status,
            ]);
        }
    }

    /**
     * @param  int $id
     * @return Company|Builder|Model|object|null
     */
    public function addToBillingCompany(int $id) {
        $healthP = HealthProfessional::find($id);
        if (is_null($healthP)) return null;

        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;

        if (is_null($healthP->billingCompanies()->find($billingCompany->id))) {
            $healthP->billingCompanies()->attach($billingCompany->id);
        }
        return $healthP;
    }

    public function getListTypes() {
        return getList(HealthProfessionalType::class, 'type');
    }

    public function getListAuthorizations() {
        return getList(CompanyHealthProfessionalType::class, 'type');
    }

    public function updateCompanies(array $data, int $id) {
        try {
            \DB::beginTransaction();
            $healthP = HealthProfessional::find($id);
            $healthP->companies()->detach();


            if (isset($data["companies"])) {
                foreach ($data["companies"] as $company) {
                    $auth = [];
                    foreach ($company["authorization"] as $authorization) {
                        if (is_numeric($authorization)) {
                            array_push($auth, $authorization);
                        }
                    }
                    if (is_null($healthP->companies()->find($company["company_id"]))) {
                        $healthP->companies()->attach($company["company_id"], [
                            'authorization' => $auth,
                            'billing_company_id' => $company["billing_company_id"],
                        ]);
                    } else {
                        $healthP->companies()->updateExistingPivot($company["company_id"], [
                            'authorization' => $auth,
                            'billing_company_id' => $company["billing_company_id"],
                        ]);
                    }
                }
            }

            \DB::commit();
            return $healthP;
        } catch (\Exception $e) {
            \DB::rollBack();
            dd($e->getMessage());
        }
    }
}
