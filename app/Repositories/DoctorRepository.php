<?php

namespace App\Repositories;

use App\Mail\GenerateNewPassword;
use App\Models\Address;
use App\Models\Contact;
use App\Models\HealthProfessional;
use App\Models\User;
use App\Models\Profile;
use App\Models\Taxonomy;
use App\Models\SocialMedia;
use App\Models\SocialNetwork;
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
            $profile = Profile::updateOrCreate([
                "ssn" => $data["profile"]["ssn"]
            ], [
                "ssn"           => $data["profile"]["ssn"],
                "first_name"    => $data["profile"]["first_name"],
                "middle_name"   => $data["profile"]["middle_name"],
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
            /** Create User */
            $user = User::create([
                "usercode"   => generateNewCode("US", 5, date("Y"), User::class, "usercode"),
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
            $healthP = HealthProfessional::create([
                "code"    => generateNewCode("HP", 5, date("Y"), HealthProfessional::class, "code"),
                "npi"     => $data["npi"],
                "dea"     => $data["dea"],
                "user_id" => $user->id
            ]);

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
                        env('URL_FRONT') . "/#/newPassword?mcctoken=" . $token
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
                "npi"     => $data["npi"],
                "dea"     => $data["dea"]
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
                "middle_name"   => $data["profile"]["middle_name"],
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
                "taxonomies"
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
                "taxonomies"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        }
        return !is_null($healthProfessionals) ? $healthProfessionals : null;
    }

    public function getServerAllDoctors(Request $request) {
        $sortBy   = $request->sortBy ?? 'id';
        $sortDesc = $request->sortDesc ?? false;
        $page = $request->page ?? 1;
        $itemsPerPage = $request->itemsPerPage ?? 5;
        $search = $request->search ?? '';

        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $records = HealthProfessional::with([
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
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->paginate($itemsPerPage);
        } else {
            $records = HealthProfessional::whereHas("billingCompanies", function ($query) use ($bC) {
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
                "taxonomies"
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
                "taxonomies"
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
}
