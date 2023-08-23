<?php

namespace App\Repositories;

use App\Enums\HealthProfessional\HealthProfessionalType as HealthProfessionalTypeEnum;
use App\Http\Resources\Enums\EnumResource;
use App\Http\Resources\Enums\TypeResource;
use App\Http\Resources\HealthProfessional\DoctorBodyResource;
use App\Mail\GenerateNewPassword;
use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\BillingCompany\MembershipRole;
use App\Models\Company;
use App\Models\CompanyHealthProfessionalType;
use App\Models\Contact;
use App\Models\EntityNickname;
use App\Models\HealthProfessional;
use App\Models\HealthProfessionalType;
use App\Models\PrivateNote;
use App\Models\Profile;
use App\Models\PublicNote;
use App\Models\SocialMedia;
use App\Models\SocialNetwork;
use App\Models\Taxonomy;
use App\Models\TypeCatalog;
use App\Models\User;
use App\Roles\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class DoctorRepository
{
    public function createDoctor(array $data)
    {
        try {
            \DB::beginTransaction();

            /* Create Profile */
            if (isset($data['profile']['ssn'])) {
                $profile = Profile::query()->updateOrCreate([
                    'ssn' => $data['profile']['ssn'] ?? null,
                ], $data['profile']);
            } else {
                $profile = Profile::query()->updateOrCreate([
                    'first_name' => $data['profile']['first_name'],
                    'last_name' => $data['profile']['last_name'],
                    'date_of_birth' => $data['profile']['date_of_birth'],
                ], $data['profile']);
            }

            /* Create User si boolean create user its true */
            if ($data['create_user']) {
                $user = User::query()->updateOrCreate([
                    'email' => $data['contact']['email'],
                ], [
                    'usercode' => generateNewCode('US', 5, date('Y'), User::class, 'usercode'),
                    'userkey' => encrypt(uniqid('', true)),
                    'profile_id' => $profile->id,
                ]);
            }

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'];
            } else {
                $billingCompany = auth()->user()->billing_company_id;
            }

            /* Attach billing company */
            if (isset($user)) {
                $user->billingCompanies()->syncWithoutDetaching($billingCompany);
                $user->billingCompanies()
                    ->wherePivot('billing_company_id', $billingCompany)
                    ->first()
                    ->membership
                    ->roles()
                    ->syncWithoutDetaching(MembershipRole::whereSlug('healthprofessional')->first()->id);
            }

            if (isset($data['profile']['social_medias'])) {
                $socialMediaNames = array_column($data['profile']['social_medias'], 'name');
            
                // Delete socialMedia
                $profile->socialMedias->each(function ($socialMedia) use ($socialMediaNames) {
                    $socialNetwork = $socialMedia->SocialNetwork;
                    if ($socialNetwork && in_array($socialNetwork->name, $socialMediaNames)) {
                        $socialMedia->delete();
                    }
                });
            
                // Update or create new social medias
                foreach ($data['profile']['social_medias'] as $socialMedia) {
                    $socialNetwork = SocialNetwork::whereName($socialMedia['name'])->first();
                    if ($socialNetwork) {
                        SocialMedia::updateOrCreate([
                            'profile_id' => $profile->id,
                            'social_network_id' => $socialNetwork->id,
                            'billing_company_id' => $billingCompany,
                        ], [
                            'link' => $socialMedia['link'],
                        ]);
                    }
                }
            }
            

            if (!$data['is_provider']) {
                $company = Company::query()->find($data['company_id']);
            } else {
                $company = Company::query()->create([
                    'code' => generateNewCode(getPrefix($data['profile']['first_name'].' '.$data['profile']['last_name'].' '.$data['npi']), 5, date('Y'), Company::class, 'code'),
                    'name' => $data['profile']['first_name'].' '.$data['profile']['last_name'].' '.$data['npi'],
                    'npi' => $data['npi'],
                    'ein' => $data['ein'] ?? null,
                    'upin' => $data['upin'] ?? null,
                ]);

                // Create Nikname for new company
                if (isset($data['nickname'])) {
                    EntityNickname::updateOrCreate([
                        'nicknamable_id' => $company->id,
                        'nicknamable_type' => Company::class,
                        'billing_company_id' => $billingCompany,
                    ], [
                        'nickname' => $data['nickname'],
                    ]);
                }

                // Address and Contact for Company
                if (isset($data['contact'])) {
                    $data['contact']['contactable_id'] = $company->id;
                    $data['contact']['contactable_type'] = Company::class;
                    $data['contact']['billing_company_id'] = $billingCompany;
                    Contact::create($data['contact']);
                }

                if (isset($data['address'])) {
                    $data['address']['addressable_id'] = $company->id;
                    $data['address']['addressable_type'] = Company::class;
                    $data['address']['billing_company_id'] = $billingCompany;
                    $data['address']['address_type_id'] = 1;
                    Address::create($data['address']);
                }
            }

            $healthP = HealthProfessional::query()->firstOrCreate(
                [
                    'npi' => $data['npi'],
                ],
                [
                    'code' => generateNewCode('HP', 5, date('Y'), HealthProfessional::class, 'code'),
                    'is_provider' => $data['is_provider'] ?? false,
                    'npi_company' => $data['npi_company'] ?? '',
                    'ein' => $data['ein'] ?? null,
                    'upin' => $data['upin'] ?? null,
                    'company_id' => $company->id ?? $data['company_id'],
                    'profile_id' => $profile->id,
                ],
            );

            $type = HealthProfessionalType::query()->updateOrCreate([
                'billing_company_id' => $billingCompany,
                'health_professional_id' => $healthP->id,
            ], [
                'type' => (string) $data['health_professional_type_id'],
            ]);

            $healthP->companies()->syncWithPivotValues($company->id ?? $data['company_id'], [
                'authorization' => $data['authorization'],
                'billing_company_id' => $billingCompany,
            ]);

            if (isset($data['private_note'])) {
                PrivateNote::create([
                    'publishable_type' => HealthProfessional::class,
                    'publishable_id' => $healthP->id,
                    'billing_company_id' => $billingCompany,
                    'note' => $data['private_note'],
                ]);
            }

            if (isset($data['public_note'])) {
                PublicNote::create([
                    'publishable_type' => HealthProfessional::class,
                    'publishable_id' => $healthP->id,
                    'note' => $data['public_note'],
                ]);
            }

            // Address and Contact for Health Professional
            if (isset($data['contact'])) {
                $data['contact']['contactable_id'] = $profile->id;
                $data['contact']['contactable_type'] = Profile::class;
                $data['contact']['billing_company_id'] = $billingCompany;
                Contact::create($data['contact']);
            }

            if (isset($data['address'])) {
                $data['address']['addressable_id'] = $profile->id;
                $data['address']['addressable_type'] = Profile::class;
                $data['address']['billing_company_id'] = $billingCompany;
                $data['address']['address_type_id'] = 1;
                Address::create($data['address']);
            }

            if (is_null($healthP->billingCompanies()->find($billingCompany))) {
                $healthP->billingCompanies()->attach($billingCompany, [
                    'is_provider' => $data['is_provider'] ?? false,
                    'npi_company' => $data['npi_company'] ?? '',
                    'company_id' => $company->id ?? $data['company_id'],
                    'health_professional_type_id' => $type?->id,
                ]);
            } else {
                $healthP->billingCompanies()->updateExistingPivot(
                    $billingCompany,
                    [
                        'status' => true,
                        'is_provider' => $data['is_provider'] ?? false,
                        'npi_company' => $data['npi_company'] ?? '',
                        'company_id' => $company->id ?? $data['company_id'],
                        'health_professional_type_id' => $type?->id,
                        'miscellaneous' => $data['miscellaneous'] ?? null,
                    ]
                );
            }

            if (isset($data['taxonomies'])) {
                $company->taxonomies()->wherePivot('billing_company_id', $billingCompany)->detach();
                $healthP->taxonomies()->wherePivot('billing_company_id', $billingCompany)->detach();

                foreach ($data['taxonomies'] as $taxonomy) {
                    $tax = Taxonomy::updateOrCreate(['tax_id' => $taxonomy['tax_id']], $taxonomy);

                    // @todo: refactorizar esta logica para el asociar taxonomies a companies y healthP

                    // logic for attach taxonomies to companies
                    $check = $company->taxonomies()
                        ->wherePivot('billing_company_id', $billingCompany)
                        ->find($tax->id);

                    if ($check) {
                        $company->taxonomies()
                        ->wherePivot('billing_company_id', $billingCompany)
                        ->updateExistingPivot($tax->id, [
                            'primary' => $taxonomy['primary'],
                        ]);
                    } else {
                        $company->taxonomies()->attach($tax->id, [
                            'billing_company_id' => $billingCompany,
                            'primary' => $taxonomy['primary'],
                        ]);
                    }

                    // logic for attach taxonomies to health professional
                    $check = $healthP->taxonomies()
                        ->wherePivot('billing_company_id', $billingCompany)
                        ->find($tax->id);

                    if ($check) {
                        $healthP->taxonomies()
                        ->wherePivot('billing_company_id', $billingCompany)
                        ->updateExistingPivot($tax->id, [
                            'primary' => $taxonomy['primary'],
                        ]);
                    } else {
                        $healthP->taxonomies()->attach($tax->id, [
                            'billing_company_id' => $billingCompany,
                            'primary' => $taxonomy['primary'],
                        ]);
                    }
                }
            }

            if (!is_null($healthP) && isset($user)) {
                $role = Role::whereSlug('healthprofessional')->first();
                $user->attachRole($role);

                $token = encrypt($user->id.'@#@#$'.$user->email);
                $user->token = $token;
                $user->save();

                Mail::to($user->email)->send(
                    new GenerateNewPassword(
                        $profile->first_name.' '.$profile->last_name,
                        $user->email,
                        \Crypt::decrypt($user->userkey),
                        env('URL_FRONT').'/#/newCredentials?mcctoken='.$token
                    )
                );
            }

            \DB::commit();

            return new DoctorBodyResource($healthP);
        } catch (\Exception $e) {
            \DB::rollBack();

            throw $e;
        }
    }

    /**
     * @return Builder|Model|object|User|null
     */
    public function updateDoc(array $data, int $id)
    {
        try {
            \DB::beginTransaction();

            $healthP = HealthProfessional::query()->find($id);

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'];
            } else {
                $billingCompany = auth()->user()->billing_company_id;
            }

            $healthP->update([
                'is_provider' => $data['is_provider'] ?? false,
                'npi_company' => $data['npi_company'] ?? '',
                'ein' => $data['ein'] ?? null,
                'upin' => $data['upin'] ?? null,
                'company_id' => $data['company_id']
            ]);

            $healthP->profile()->update([
                'sex' => $data['profile']['sex'],
                'first_name' => $data['profile']['first_name'],
                'last_name' => $data['profile']['last_name'],
                'name_suffix_id' => $data['profile']['name_suffix_id'] ?? null,
                'middle_name' => $data['profile']['middle_name'],
                'ssn' => $data['profile']['ssn'],
                'date_of_birth' => $data['profile']['date_of_birth'],
            ]);

            /** Create User si boolean create user its true */
            if ($data['create_user']) {
                $user = User::query()->updateOrCreate([
                    'email' => $data['contact']['email'],
                ], [
                    'usercode' => generateNewCode('US', 5, date('Y'), User::class, 'usercode'),
                    'userkey' => encrypt(uniqid('', true)),
                    'profile_id' => $healthP->profile->id, // Revisar esto cuando se vaya a probar
                ]);
            }

            /* Attach billing company */
            if(isset($user)) {
                $user->billingCompanies()->syncWithoutDetaching($billingCompany);
                $user->billingCompanies()
                    ->wherePivot('billing_company_id', $billingCompany)
                    ->first()
                    ->membership
                    ->roles()
                    ->syncWithoutDetaching(MembershipRole::whereSlug('healthprofessional')->first()->id);
            }

            if (isset($data['profile']['social_medias'])) {
                $socialMediaNames = array_column($data['profile']['social_medias'], 'name');

                // Delete socialMedia
                $healthP->profile->socialMedias->each(function ($socialMedia) use ($socialMediaNames) {
                    $socialNetwork = $socialMedia->SocialNetwork;
                    if ($socialNetwork && in_array($socialNetwork->name, $socialMediaNames)) {
                        $socialMedia->delete();
                    }
                });

                // Update or create new social medias
                foreach ($data['profile']['social_medias'] as $socialMedia) {
                    $socialNetwork = SocialNetwork::whereName($socialMedia['name'])->first();
                    if ($socialNetwork) {
                        SocialMedia::updateOrCreate([
                            'profile_id' => $healthP->profile->id,
                            'social_network_id' => $socialNetwork->id,
                            'billing_company_id' => $billingCompany,
                        ], [
                            'link' => $socialMedia['link'],
                        ]);
                    }
                }
            }

            if (!$data['is_provider']) {
                $company = Company::query()->find($data['company_id']);
            }
            else {
                $company = Company::query()->updateOrCreate(
                    ['npi' => $data['npi']],
                    [
                        'code' => generateNewCode(getPrefix($data['profile']['first_name'].' '.$data['profile']['last_name'].' '.$data['npi']), 5, date('Y'), Company::class, 'code'),
                        'name' => $data['profile']['first_name'].' '.$data['profile']['last_name'].' '.$data['npi'],
                        'npi' => $data['npi'],
                        'ein' => $data['ein'] ?? null,
                        'upin' => $data['upin'] ?? null,
                    ],
                );

                //Create Nikname for new company
                if (isset($data['nickname'])) {
                    EntityNickname::updateOrCreate([
                        'nicknamable_id' => $company->id,
                        'nicknamable_type' => Company::class,
                        'billing_company_id' => $billingCompany,
                    ], [
                        'nickname' => $data['nickname'],
                    ]);
                }

                // Address and Contact for Company
                if (isset($data['contact'])) {
                    $data['contact']['contactable_id'] = $company->id;
                    $data['contact']['contactable_type'] = Company::class;
                    $data['contact']['billing_company_id'] = $billingCompany;
                    $data['address']['address_type_id'] = 1;
                    Contact::updateOrCreate(
                        [
                            'contactable_id' => $company->id,
                            'contactable_type' => Company::class,
                            'billing_company_id' => $billingCompany
                        ],
                        $data['contact']
                    );
                }

                if (isset($data['address'])) {
                    $data['address']['addressable_id'] = $company->id;
                    $data['address']['addressable_type'] = Company::class;
                    $data['address']['billing_company_id'] = $billingCompany;
                    Address::updateOrCreate(
                        [
                            'addressable_id' => $company->id,
                            'addressable_type' => Company::class,
                            'billing_company_id' => $billingCompany
                        ],
                        $data['address']
                    );
                }
            }

            $type = HealthProfessionalType::query()->updateOrCreate([
                'billing_company_id' => $billingCompany,
                'health_professional_id' => $healthP->id,
            ], [
                'type' => (string) $data['health_professional_type_id'],
            ]);

            $healthP->companies()->syncWithPivotValues($company->id ?? $data['company_id'], [
                'authorization' => $data['authorization'],
                'billing_company_id' => $billingCompany,
            ]);

            if (isset($data['private_note'])) {
                PrivateNote::create([
                    'publishable_type' => HealthProfessional::class,
                    'publishable_id' => $healthP->id,
                    'billing_company_id' => $billingCompany,
                    'note' => $data['private_note'],
                ]);
            }

            if (isset($data['public_note'])) {
                PublicNote::create([
                    'publishable_type' => HealthProfessional::class,
                    'publishable_id' => $healthP->id,
                    'note' => $data['public_note'],
                ]);
            }

            // Address and Contact for Health Professional
            if (isset($data['contact'])) {
                $data['contact']['contactable_id'] = $healthP->profile->id;
                $data['contact']['contactable_type'] = Profile::class;
                $data['contact']['billing_company_id'] = $billingCompany;
                Contact::updateOrCreate(
                    [
                        'contactable_id' => $healthP->profile->id,
                        'contactable_type' => Profile::class,
                        'billing_company_id' => $billingCompany
                    ],
                    $data['contact']
                );
            }

            if (isset($data['address'])) {
                $data['address']['addressable_id'] = $healthP->profile->id;
                $data['address']['addressable_type'] = Profile::class;
                $data['address']['billing_company_id'] = $billingCompany;
                $data['address']['address_type_id'] = 1;
                Address::updateOrCreate(
                    [
                        'addressable_id' => $healthP->profile->id,
                        'addressable_type' => Profile::class,
                        'billing_company_id' => $billingCompany
                    ],
                    $data['address']
                );
            }

            if (is_null($healthP->billingCompanies()->find($billingCompany))) {
                $healthP->billingCompanies()->attach($billingCompany, [
                    'is_provider' => $data['is_provider'] ?? false,
                    'npi_company' => $data['npi_company'] ?? '',
                    'company_id' => $company->id ?? $data['company_id'],
                    'health_professional_type_id' => $type?->id,
                ]);
            } else {
                $healthP->billingCompanies()->updateExistingPivot(
                    $billingCompany,
                    [
                        'status' => true,
                        'is_provider' => $data['is_provider'] ?? false,
                        'npi_company' => $data['npi_company'] ?? '',
                        'company_id' => $company->id ?? $data['company_id'],
                        'health_professional_type_id' => $type?->id,
                        'miscellaneous' => $data['miscellaneous'] ?? null,
                    ]
                );
            }

            if (isset($data['taxonomies'])) {

                $company->taxonomies()->wherePivot('billing_company_id', $billingCompany)->detach();
                $healthP->taxonomies()->wherePivot('billing_company_id', $billingCompany)->detach();

                foreach ($data['taxonomies'] as $taxonomy) {
                    $tax = Taxonomy::updateOrCreate(['tax_id' => $taxonomy['tax_id']], $taxonomy);

                    //@todo: refactorizar esta logica para el asociar taxonomies a companies y healthP

                    //logic for attach taxonomies to companies
                    $check = $company->taxonomies()
                        ->wherePivot('billing_company_id', $billingCompany)
                        ->find($tax->id);

                    if($check) {
                        $company->taxonomies()
                        ->wherePivot('billing_company_id', $billingCompany)
                        ->updateExistingPivot($tax->id, [
                            'primary' => $taxonomy['primary']
                        ]);
                    }
                    else {
                        $company->taxonomies()->attach($tax->id, [
                            'billing_company_id' => $billingCompany,
                            'primary' => $taxonomy['primary']
                        ]);
                    }

                    //logic for attach taxonomies to health professional
                    $check = $healthP->taxonomies()
                        ->wherePivot('billing_company_id', $billingCompany)
                        ->find($tax->id);

                    if($check) {
                        $healthP->taxonomies()
                        ->wherePivot('billing_company_id', $billingCompany)
                        ->updateExistingPivot($tax->id, [
                            'primary' => $taxonomy['primary']
                        ]);
                    }
                    else {
                        $healthP->taxonomies()->attach($tax->id, [
                            'billing_company_id' => $billingCompany,
                            'primary' => $taxonomy['primary']
                        ]);
                    }
                }
            }

            if (!is_null($healthP) && isset($user)) {
                $role = Role::whereSlug('healthprofessional')->first();
                $user->attachRole($role);

                $token = encrypt($user->id.'@#@#$'.$user->email);
                $user->token = $token;
                $user->save();

                Mail::to($user->email)->send(
                    new GenerateNewPassword(
                        $healthP->profile->first_name.' '.$healthP->profile->last_name,
                        $user->email,
                        \Crypt::decrypt($user->userkey),
                        env('URL_FRONT').'/#/newCredentials?mcctoken='.$token
                    )
                );
            }
            
            \DB::commit();

            return new DoctorBodyResource($healthP);

        } catch (\Exception $e) {
            \DB::rollBack();

            throw $e;
        }
    }

    /**
     * @return Collection|Doctor[]
     */
    public function getAllDoctors()
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $healthProfessionals = HealthProfessional::with([
                'profile' => function ($query) {
                    $query->with(['socialMedias', 'addresses', 'contacts']);
                },
                'user' => function ($query) {
                    $query->with([
                        'roles',
                        'billingCompanies',
                    ]);
                },
                'taxonomies',
                'companies' => function ($query) {
                    $query->with(['taxonomies', 'nicknames']);
                },
                'healthProfessionalType',
                'company',
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        } else {
            $healthProfessionals = HealthProfessional::whereHas('billingCompanies', function ($query) use ($bC) {
                $query->where('billing_company_id', $bC);
            })->with([
                'profile' => function ($query) use ($bC) {
                    $query->with([
                        'socialMedias',
                        'addresses' => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                        'contacts' => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                    ]);
                },
                'user' => function ($query) use ($bC) {
                    $query->with([
                        'roles',
                        'billingCompanies',
                    ]);
                },
                'taxonomies',
                'companies' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC)
                        ->with(['taxonomies', 'nicknames']);
                },
                'healthProfessionalType',
                'company',
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        }

        return !is_null($healthProfessionals) ? $healthProfessionals : null;
    }

    public function getServerAllDoctors(Request $request)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = HealthProfessional::with([
                'profile' => function ($query) {
                    $query->with(['socialMedias', 'addresses', 'contacts']);
                },
                'billingCompanies',
                'user' => function ($query) {
                    $query->with(['roles']);
                },
                'taxonomies',
                'companies' => function ($query) {
                    $query->with(['taxonomies', 'nicknames']);
                },
                'healthProfessionalType',
                'company',
            ]);
        } else {
            $data = HealthProfessional::whereHas('billingCompanies', function ($query) use ($bC) {
                $query->where('billing_company_id', $bC);
            })->with([
                'profile' => function ($query) use ($bC) {
                    $query->with([
                        'socialMedias',
                        'addresses' => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                        'contacts' => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                    ]);
                },
                'billingCompanies',
                'user' => function ($query) use ($bC) {
                    $query->with(['roles']);
                },
                'taxonomies',
                'companies' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC)
                        ->with(['taxonomies', 'nicknames']);
                },
                'healthProfessionalType',
                'company',
            ]);
        }

        if (!empty($request->query('query')) && '{}' !== $request->query('query')) {
            $data = $data->search($request->query('query'));
        }

        if ($request->sortBy) {
            if (str_contains($request->sortBy, 'billingcompany')) {
                $data = $data->orderBy(
                    BillingCompany::select('name')->whereColumn('billing_companies.id', 'health_professionals.billing_company_id'), (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } /**elseif (str_contains($request->sortBy, 'email')) {
                $data = $data->orderBy(
                    Contact::select('email')->whereColumn('contats.id', 'companies.billing_company_id'), (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } */ else {
                $data = $data->orderBy($request->sortBy, (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
            }
        } else {
            $data = $data->orderBy('created_at', 'desc')->orderBy('id', 'asc');
        }

        $data = $data->paginate($request->itemsPerPage ?? 10);

        return response()->json([
            'data' => $data->items(),
            'numberOfPages' => $data->lastPage(),
            'count' => $data->total(),
        ], 200);
    }

    /**
     * @return Doctor|Builder|Model|object|null
     */
    public function getOneDoctor(int $id)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $healthP = HealthProfessional::whereId($id)->with([
                'user' => function ($query) {
                    $query->with([
                        'profile' => function ($query) {
                            $query->with('socialMedias', 'addresses', 'contacts');
                        },
                        'roles',
                        'billingCompanies',
                    ]);
                },
                'taxonomies',
                'companies' => function ($query) {
                    $query->with(['taxonomies', 'nicknames']);
                },
                'healthProfessionalType',
                'company' => function ($query) {
                    $query->with(['taxonomies', 'nicknames']);
                },
                'privateNotes',
                'publicNote',
            ])->first();
            $healthP->user->profile->socialMedias->groupBy('billing_company_id');
            $healthP->user->addresses->groupBy('billing_company_id');
            $healthP->user->contacts->groupBy('billing_company_id');
        } else {
            $healthP = HealthProfessional::whereId($id)->with([
                'user' => function ($query) use ($bC) {
                    $query->with([
                        'profile' => function ($query) use ($bC) {
                            $query->with([
                                'socialMedias',
                                'addresses' => function ($query) use ($bC) {
                                    $query->where('billing_company_id', $bC);
                                },
                                'contacts' => function ($query) use ($bC) {
                                    $query->where('billing_company_id', $bC);
                                },
                            ]);
                        },
                        'roles',
                        'billingCompanies',
                    ]);
                },
                'taxonomies',
                'companies' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC)
                          ->with(['taxonomies', 'nicknames']);
                },
                'healthProfessionalType',
                'company' => function ($query) use ($bC) {
                    $query->with([
                            'taxonomies',
                            'nicknames' => function ($q) use ($bC) {
                                $q->where('billing_company_id', $bC);
                            },
                        ]);
                },
                'privateNotes' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'publicNote',
            ])->first();
        }

        return !is_null($healthP) ? $healthP : null;
    }

    /**
     * @return Doctor|Builder|Model|object|null
     */
    public function getOneByNpi(string $npi)
    {
        $healthP = HealthProfessional::query()
            ->whereNpi($npi)
            // ->with(['taxonomies', 'publicNote'])
            ->first();

        if ($healthP) {
            $billingCompaniesException = $healthP->billingCompanies()
                ->get()
                ->pluck('id')
                ->toArray();

            $billingCompanies = BillingCompany::query()
                ->where('status', true)
                ->when(Gate::denies('is-admin'), function ($query) {
                    $billingCompaniesUser = auth()->user()->billingCompanies
                        ->take(1)
                        ->pluck('id')
                        ->toArray();

                    return $query->whereIn('billing_companies.id', $billingCompaniesUser ?? []);
                })
                ->whereNotIn('billing_companies.id', $billingCompaniesException ?? [])
                ->get()
                ->pluck('id')
                ->toArray();

            if (empty($billingCompanies)) {
                // return ['result' => false];
                return !is_null($healthP) ? $healthP : null;
            }
        }
        // return !is_null($healthP) ? ['data' => $healthP, 'result' => true] : null;
        return null;

        $bC = auth()->user()->billing_company_id ?? null;
        $query = HealthProfessional::whereNpi($npi);

        if (!$query->exists()) {
            return null;
        }

        if (!$bC) {
            $healthP = $query->with([
                'user' => function ($query) {
                    $query->with([
                        'profile' => function ($query) {
                            $query->with(['socialMedias', 'addresses', 'contacts']);
                        },
                        'roles',
                        'billingCompanies',
                    ]);
                },
                'taxonomies',
                'companies' => function ($query) {
                    $query->with(['taxonomies', 'nicknames']);
                },
                'healthProfessionalType',
                'company' => function ($query) {
                    $query->with(['taxonomies', 'nicknames']);
                },
                'privateNotes',
                'publicNote',
            ])->first();
            $healthP->user->profile->socialMedias->groupBy('billing_company_id');
            $healthP->user->addresses->groupBy('billing_company_id');
            $healthP->user->contacts->groupBy('billing_company_id');
        } else {
            $healthP = HealthProfessional::whereNpi($npi)->with([
                'user' => function ($query) use ($bC) {
                    $query->with([
                        'profile' => function ($query) use ($bC) {
                            $query->with([
                                'socialMedias',
                                'addresses' => function ($query) use ($bC) {
                                    $query->where('billing_company_id', $bC);
                                },
                                'contacts' => function ($query) use ($bC) {
                                    $query->where('billing_company_id', $bC);
                                },
                            ]);
                        },
                        'roles',
                        'billingCompanies',
                    ]);
                },
                'taxonomies',
                'companies' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC)
                        ->with(['taxonomies', 'nicknames']);
                },
                'healthProfessionalType',
                'company' => function ($query) use ($bC) {
                    $query->with([
                            'taxonomies',
                            'nicknames' => function ($q) use ($bC) {
                                $q->where('billing_company_id', $bC);
                            },
                        ]);
                },
                'privateNotes' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'publicNote',
            ])->first();
        }

        return $healthP;
    }

    /**
     * @return bool|int|null
     */
    public function changeStatus(bool $status, int $id)
    {
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) {
            return null;
        }

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
     * @return Company|Builder|Model|object|null
     */
    public function addToBillingCompany(int $id)
    {
        $healthP = HealthProfessional::find($id);
        if (is_null($healthP)) {
            return null;
        }

        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) {
            return null;
        }

        if (is_null($healthP->billingCompanies()->find($billingCompany->id))) {
            $healthP->billingCompanies()->attach($billingCompany->id);
        }

        return $healthP;
    }

    public function getListTypes()
    {
        return new EnumResource(collect(HealthProfessionalTypeEnum::cases()), TypeResource::class);
    }

    public function getListAuthorizations()
    {
        return getList(CompanyHealthProfessionalType::class, 'type');
    }

    public function getListBillingCompanies(Request $request)
    {
        $healthProfessionalId = $request->health_professional_id ?? null;
        $edit = $request->edit ?? 'false';

        if (is_null($healthProfessionalId)) {
            return getList(BillingCompany::class, 'name', ['status' => true]);
        } else {
            $ids = [];
            $billingCompanies = HealthProfessional::find($healthProfessionalId)->billingCompanies;
            foreach ($billingCompanies as $field) {
                array_push($ids, $field->id);
            }
            if ('true' == $edit) {
                return getList(BillingCompany::class, 'name', ['where' => ['status' => true], 'exists' => 'healthProfessionals', 'whereHas' => ['relationship' => 'healthProfessionals', 'where' => ['health_professional_id' => $healthProfessionalId]]]);
            } else {
                return getList(BillingCompany::class, 'name', ['where' => ['status' => true], 'not_exists' => 'healthProfessionals', 'orWhereHas' => ['relationship' => 'healthProfessionals', 'where' => ['billing_company_id', $ids]]]);
            }
        }
    }

    public function getList(Request $request)
    {
        $billingCompanyId = $request->billing_company_id ?? null;
        $companyId = $request->company_id ?? null;
        $authorization = $request->authorization ?? 'false';
        $taxonomy = $request->withTaxonomy ?? 'false';
        $only = $request->only ?? null;

        if (auth()->user()->hasRole('superuser')) {
            $billingCompany = $billingCompanyId;
        } else {
            $billingCompany = auth()->user()->billingCompanies->first();
        }

        $healthProfessionals = HealthProfessional::query()->with('profile', 'companies');

        if (isset($billingCompany)) {
            $healthProfessionals = $healthProfessionals->whereHas('billingCompanies', function ($query) use ($billingCompany) {
                $query->where('billing_company_id', $billingCompany->id ?? $billingCompany);
            });
        }
        if (isset($companyId)) {
            $healthProfessionals = $healthProfessionals->whereHas('companies', function ($query) use ($companyId, $billingCompany) {
                $query->where('company_id', $companyId);
                if (isset($billingCompany)) {
                    $query->where('billing_company_id', $billingCompany->id ?? $billingCompany);
                }
            });
        }
        if (!isset($billingCompany) && !isset($companyId)) {
            $healthProfessionals = HealthProfessional::Query()->with('profile', 'companies')->get();
        } else {
            $healthProfessionals = $healthProfessionals->get();
        }

        $billing_provider = CompanyHealthProfessionalType::whereType('Billing provider')->first();
        $service_provider = CompanyHealthProfessionalType::whereType('Service provider')->first();
        $referred = CompanyHealthProfessionalType::whereType('Referred')->first();

        $record = [];
        $records = [
            'billing_provider' => [],
            'referred' => [],
            'service_provider' => [],
            'referred_provider_roles' => getList(
                TypeCatalog::class,
                ['description'],
                ['relationship' => 'type', 'where' => ['description' => 'Referred or ordered provider roles']],
                null,
                ['code']
            ),
        ];
        foreach ($healthProfessionals as $healthProfessional) {
            if ('true' == $authorization) {
                foreach ($healthProfessional->companies_providers as $provider) {
                    $auth = $provider->authorization->map(function ($item) {
                        return $item->value;
                    })->toArray() ?? [];
                    if (in_array($billing_provider->id, $auth)) {
                        array_push($records['billing_provider'], [
                            'id' => $healthProfessional->id,
                            'name' => $healthProfessional->profile->first_name.' '.$healthProfessional->profile->last_name,
                            'npi' => $healthProfessional->npi,
                        ]);
                    }
                    if (in_array($referred->id, $auth)) {
                        array_push($records['referred'], [
                            'id' => $healthProfessional->id,
                            'name' => $healthProfessional->profile->first_name.' '.$healthProfessional->profile->last_name,
                            'npi' => $healthProfessional->npi,
                        ]);
                    }
                    if (in_array($service_provider->id, $auth)) {
                        array_push($records['service_provider'], [
                            'id' => $healthProfessional->id,
                            'name' => $healthProfessional->profile->first_name.' '.$healthProfessional->profile->last_name,
                            'npi' => $healthProfessional->npi,
                        ]);
                    }
                }
            } else {
                $field = [
                    'id' => $healthProfessional->id,
                    'name' => $healthProfessional->profile->first_name.' '.$healthProfessional->profile->last_name,
                    'npi' => $healthProfessional->npi,
                ];
                if ('true' == $taxonomy) {
                    $field['taxonomies'] = $healthProfessional->taxonomies->map(fn ($item) => [
                        'id' => $item->id,
                        'tax_id' => $item->tax_id,
                        'name' => $item->name,
                        'npi' => $healthProfessional->npi,
                    ])->toArray();
                }
                array_push($record, $field);
            }
        }
        if ('true' == $authorization) {
            return (!isset($only)) ? $records : $records[$only] ?? [];
        } else {
            return $record;
        }
    }

    public function updateCompanies(array $data, int $id)
    {
        try {
            \DB::beginTransaction();
            $healthP = HealthProfessional::find($id);

            if (isset($data['companies'])) {
                foreach ($data['companies'] as $company) {
                    $auth = [];
                    foreach ($company['authorization'] as $authorization) {
                        if (is_numeric($authorization)) {
                            array_push($auth, $authorization);
                        }
                    }

                    $healthP->companies()->syncWithPivotValues($company->id ?? $data['company_id'], [
                        'authorization' => $auth,
                        'billing_company_id' => $company['billing_company_id'],
                    ]);
                }
            }

            \DB::commit();

            return $healthP;
        } catch (\Exception $e) {
            \DB::rollBack();

            throw $e;
        }
    }
}
