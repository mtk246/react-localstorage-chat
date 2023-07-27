<?php

namespace App\Repositories;

use App\Enums\HealthProfessional\HealthProfessionalType as HealthProfessionalTypeEnum;
use App\Http\Resources\Enums\EnumResource;
use App\Http\Resources\Enums\TypeResource;
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
                $profile = Profile::updateOrCreate([
                    // 'first_name' => $data['profile']['first_name'],
                    // 'last_name' => $data['profile']['last_name'],
                    // 'date_of_birth' => $data['profile']['date_of_birth'],
                    'ssn' => $data['profile']['ssn'],
                ], collect($data['profile'])->toArray());
            } else {
                $profile = Profile::updateOrCreate([
                    'first_name' => $data['profile']['first_name'],
                    'last_name' => $data['profile']['last_name'],
                    'date_of_birth' => $data['profile']['date_of_birth'],
                ], collect($data['profile'])->toArray());
            }
            /** Create User */
            $user = User::query()->updateOrCreate([
                'email' => $data['email'],
            ], [
                'usercode' => generateNewCode('US', 5, date('Y'), User::class, 'usercode'),
                'userkey' => encrypt(uniqid('', true)),
                'profile_id' => $profile->id,
            ]);

            if (Auth::user()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'];
            } else {
                $billingCompany = Auth::user()->billingCompanies->first();
            }

            /* Attach billing company */
            $user->billingCompanies()->syncWithoutDetaching($billingCompany->id ?? $billingCompany);
            $user->billingCompanies()
                ->wherePivot('billing_company_id', $billingCompany->id ?? $billingCompany)
                ->first()
                ->membership
                ->roles()
                ->syncWithoutDetaching(MembershipRole::whereSlug('healthprofessional')->first()->id);

            if (isset($data['profile']['social_medias'])) {
                $socialMedias = $profile->socialMedias;
                /* Delete socialMedia */
                foreach ($socialMedias as $socialMedia) {
                    $validated = false;
                    $socialNetwork = $socialMedia->SocialNetwork;
                    if (isset($socialNetwork)) {
                        foreach ($data['profile']['social_medias'] as $socialM) {
                            if ($socialM['name'] == $socialNetwork->name) {
                                $validated = true;
                                break;
                            }
                        }
                    }
                    if (!$validated) {
                        $socialMedia->delete();
                    }
                }

                /* update or create new social medias */
                foreach ($data['profile']['social_medias'] as $socialMedia) {
                    $socialNetwork = SocialNetwork::whereName($socialMedia['name'])->first();
                    if (isset($socialNetwork)) {
                        SocialMedia::updateOrCreate([
                            'profile_id' => $profile->id,
                            'social_network_id' => $socialNetwork->id,
                            'billing_company_id' => $billingCompany?->id ?? $billingCompany,
                        ], [
                            'link' => $socialMedia['link'],
                        ]);
                    }
                }
            }

            if (isset($data['contact'])) {
                $data['contact']['contactable_id'] = $user->id;
                $data['contact']['contactable_type'] = User::class;
                $data['contact']['billing_company_id'] = $billingCompany->id ?? $billingCompany;
                Contact::create($data['contact']);
            }

            if (isset($data['address'])) {
                $data['address']['addressable_id'] = $user->id;
                $data['address']['addressable_type'] = User::class;
                $data['address']['billing_company_id'] = $billingCompany->id ?? $billingCompany;
                Address::create($data['address']);
            }
            if ($data['is_provider'] ?? false) {
                if (isset($data['npi_company'])) {
                    $company = Company::where('npi', $data['npi_company'])->first();
                    if (is_null($company)) {
                        $company = Company::create([
                            'code' => generateNewCode(getPrefix($data['name_company']), 5, date('Y'), Company::class, 'code'),
                            'name' => $data['name_company'],
                            'npi' => $data['npi_company'],
                            'ein' => $data['ein'] ?? null,
                            'upin' => $data['upin'] ?? null,
                        ]);
                    }
                    if (isset($data['taxonomies_company'])) {
                        $tax_array = [];
                        foreach ($data['taxonomies_company'] as $taxonomy) {
                            $tax = Taxonomy::updateOrCreate(['tax_id' => $taxonomy['tax_id']], $taxonomy);
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
                            'nicknamable_id' => $company->id,
                            'nicknamable_type' => Company::class,
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ], [
                            'nickname' => $data['nickname'],
                        ]);
                    }
                } else {
                    $company = Company::query()->where('npi', $data['npi'])->first();
                    if (is_null($company)) {
                        $company = Company::create([
                            'code' => generateNewCode(getPrefix($data['profile']['first_name'].' '.$data['profile']['last_name'].' '.$data['npi']), 5, date('Y'), Company::class, 'code'),
                            'name' => $data['profile']['first_name'].' '.$data['profile']['last_name'].' '.$data['npi'],
                            'npi' => $data['npi'],
                            'ein' => $data['ein'] ?? null,
                            'upin' => $data['upin'] ?? null,
                        ]);
                    }
                    if (isset($data['taxonomies'])) {
                        $tax_array = [];
                        foreach ($data['taxonomies'] as $taxonomy) {
                            $tax = Taxonomy::updateOrCreate(['tax_id' => $taxonomy['tax_id']], $taxonomy);
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
                            'nicknamable_id' => $company->id,
                            'nicknamable_type' => Company::class,
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ], [
                            'nickname' => $data['nickname'],
                        ]);
                    }
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
                    'user_id' => $user->id,
                ],
            );

            $type = HealthProfessionalType::query()->updateOrCreate([
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
                'health_professional_id' => $healthP->id,
            ], [
                'type' => (string) $data['health_professional_type_id'],
            ]);

            $auth = [];

            if (
                HealthProfessionalTypeEnum::MEDICAL_DOCTOR->value === $data['health_professional_type_id']
                && isset($data['is_provider'])
                    ? !$data['is_provider']
                    : false
            ) {
                foreach ($data['authorization'] as $authorization) {
                    if (is_numeric($authorization)) {
                        array_push($auth, $authorization);
                    }
                }
            }

            $healthP->companies()->syncWithPivotValues($company->id ?? $data['company_id'], [
                'authorization' => $auth,
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
            ]);

            if (isset($data['private_note'])) {
                PrivateNote::create([
                    'publishable_type' => HealthProfessional::class,
                    'publishable_id' => $healthP->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
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

            if (is_null($healthP->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $healthP->billingCompanies()->attach($billingCompany->id ?? $billingCompany, [
                    'is_provider' => $data['is_provider'] ?? false,
                    'npi_company' => $data['npi_company'] ?? '',
                    'company_id' => $company->id ?? $data['company_id'],
                    'health_professional_type_id' => $type?->id,
                ]);
            } else {
                $healthP->billingCompanies()->updateExistingPivot(
                    $billingCompany->id ?? $billingCompany,
                    [
                        'status' => true,
                        'is_provider' => $data['is_provider'] ?? false,
                        'npi_company' => $data['npi_company'] ?? '',
                        'company_id' => $company->id ?? $data['company_id'],
                        'health_professional_type_id' => $type?->id,
                    ]
                );
            }

            if (isset($data['taxonomies'])) {
                $tax_array = [];
                foreach ($data['taxonomies'] as $taxonomy) {
                    $tax = Taxonomy::updateOrCreate(['tax_id' => $taxonomy['tax_id']], $taxonomy);
                    array_push($tax_array, $tax->id);
                }
                $healthP->taxonomies()->sync($tax_array);
            }

            if (!is_null($healthP) && !is_null($user)) {
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
            } else {
                \DB::rollBack();

                return null;
            }

            \DB::commit();

            return $this->getOneDoctor($healthP->id);
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

            assert($healthP instanceof HealthProfessional);

            if (Auth::User()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            $healthP->update([
                'npi' => $data['npi'],
                'is_provider' => $data['is_provider'] ?? false,
                'npi_company' => $data['npi_company'] ?? '',
                'company_id' => $data['company_id'] ?? null,
                'ein' => $data['ein'] ?? null,
                'upin' => $data['upin'] ?? null,
            ]);

            HealthProfessionalType::query()->updateOrCreate([
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
                'health_professional_id' => $healthP->id,
            ], [
                'type' => (string) $data['health_professional_type_id'],
            ]);

            if (isset($data['taxonomies'])) {
                $tax_array = [];
                foreach ($data['taxonomies'] as $taxonomy) {
                    $tax = Taxonomy::updateOrCreate([
                        'tax_id' => $taxonomy['tax_id'],
                    ], $taxonomy);
                    array_push($tax_array, $tax->id);
                }
                $healthP->taxonomies()->sync($tax_array);
            }

            /** Edit User */
            $user = $healthP->user;
            $user->update([
                'email' => $data['email'],
            ]);

            /** Edit Profile */
            $profile = $user->profile;

            $profile->update([
                'ssn' => $data['profile']['ssn'],
                'first_name' => $data['profile']['first_name'],
                'middle_name' => $data['profile']['middle_name'] ?? '',
                'last_name' => $data['profile']['last_name'],
                'sex' => $data['profile']['sex'],
                'date_of_birth' => $data['profile']['date_of_birth'],
                'name_suffix_id' => $data['profile']['name_suffix_id'] ?? null,
            ]);

            if (is_null($healthP->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $healthP->billingCompanies()->attach($billingCompany->id ?? $billingCompany, [
                    'is_provider' => $data['is_provider'] ?? false,
                    'npi_company' => $data['npi_company'] ?? '',
                    'company_id' => $data['company_id'] ?? null,
                    'health_professional_type_id' => $data['health_professional_type_id'],
                ]);
            } else {
                $healthP->billingCompanies()->updateExistingPivot(
                    $billingCompany->id ?? $billingCompany,
                    [
                        'status' => true,
                        'is_provider' => $data['is_provider'] ?? false,
                        'npi_company' => $data['npi_company'] ?? '',
                        'company_id' => $data['company_id'] ?? null,
                        'health_professional_type_id' => $data['health_professional_type_id'],
                    ]
                );
            }

            $user->billingCompanies()->syncWithoutDetaching($billingCompany->id ?? $billingCompany);
            $user->billingCompanies()
                ->wherePivot('billing_company_id', $billingCompany->id ?? $billingCompany)
                ->first()
                ->membership
                ->roles()
                ->syncWithoutDetaching(MembershipRole::whereSlug('healthprofessional')->first()->id);

            if (isset($data['profile']['social_medias'])) {
                $socialMedias = $profile->socialMedias;
                /* Delete socialMedia */
                foreach ($socialMedias as $socialMedia) {
                    $validated = false;
                    $socialNetwork = $socialMedia->SocialNetwork;
                    if (isset($socialNetwork)) {
                        foreach ($data['profile']['social_medias'] as $socialM) {
                            if ($socialM['name'] == $socialNetwork->name) {
                                $validated = true;
                                break;
                            }
                        }
                    }
                    if (!$validated) {
                        $socialMedia->delete();
                    }
                }

                /* update or create new social medias */
                foreach ($data['profile']['social_medias'] as $socialMedia) {
                    $socialNetwork = SocialNetwork::whereName($socialMedia['name'])->first();
                    if (isset($socialNetwork)) {
                        SocialMedia::updateOrCreate([
                            'profile_id' => $profile->id,
                            'social_network_id' => $socialNetwork->id,
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ], [
                            'link' => $socialMedia['link'],
                        ]);
                    }
                }
            }

            if (isset($data['contact'])) {
                Contact::updateOrCreate([
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'contactable_id' => $user->id,
                    'contactable_type' => User::class,
                ], $data['contact']);
            }

            if (isset($data['address'])) {
                Address::updateOrCreate([
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'addressable_id' => $user->id,
                    'addressable_type' => User::class,
                ], $data['address']);
            }

            if (isset($data['public_note'])) {
                /* PublicNote */
                PublicNote::updateOrCreate([
                    'publishable_type' => HealthProfessional::class,
                    'publishable_id' => $healthP->id,
                ], [
                    'note' => $data['public_note'],
                ]);
            }

            if (isset($data['private_note'])) {
                /* PrivateNote */
                PrivateNote::updateOrCreate([
                    'publishable_type' => HealthProfessional::class,
                    'publishable_id' => $healthP->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'note' => $data['private_note'],
                ]);
            }

            if ($data['is_provider'] ?? false) {
                if (isset($data['npi_company'])) {
                    $company = Company::where('npi', $data['npi_company'])->first();
                    if (!isset($company)) {
                        $company = Company::create([
                            'code' => generateNewCode(getPrefix($data['name_company']), 5, date('Y'), Company::class, 'code'),
                            'name' => $data['name_company'],
                            'npi' => $data['npi_company'],
                            'ein' => $data['ein'] ?? null,
                            'upin' => $data['upin'] ?? null,
                        ]);
                    }
                    if (isset($data['taxonomies_company'])) {
                        $tax_array = [];
                        foreach ($data['taxonomies_company'] as $taxonomy) {
                            $tax = Taxonomy::updateOrCreate(['tax_id' => $taxonomy['tax_id']], $taxonomy);
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
                            'nicknamable_id' => $company->id,
                            'nicknamable_type' => Company::class,
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ], [
                            'nickname' => $data['nickname'],
                        ]);
                    }
                } else {
                    $company = Company::where('npi', $data['npi'])->first();
                    if (!isset($company)) {
                        $company = Company::create([
                            'code' => generateNewCode(getPrefix($data['profile']['first_name'].' '.$data['profile']['last_name']), 5, date('Y'), Company::class, 'code'),
                            'name' => $data['profile']['first_name'].' '.$data['profile']['last_name'],
                            'npi' => $data['npi'],
                            'ein' => $data['ein'] ?? null,
                            'upin' => $data['upin'] ?? null,
                        ]);
                    }
                    if (isset($data['taxonomies'])) {
                        $tax_array = [];
                        foreach ($data['taxonomies'] as $taxonomy) {
                            $tax = Taxonomy::updateOrCreate(['tax_id' => $taxonomy['tax_id']], $taxonomy);
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
                            'nicknamable_id' => $company->id,
                            'nicknamable_type' => Company::class,
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ], [
                            'nickname' => $data['nickname'],
                        ]);
                    }
                }
            }

            $auth = [];

            if (
                HealthProfessionalTypeEnum::MEDICAL_DOCTOR->value === $data['health_professional_type_id']
                && isset($data['is_provider'])
                    ? !$data['is_provider']
                    : false
            ) {
                foreach ($data['authorization'] as $authorization) {
                    if (is_numeric($authorization)) {
                        array_push($auth, $authorization);
                    }
                }
            }

            $healthP->companies()->syncWithPivotValues($company->id ?? $data['company_id'], [
                'authorization' => $auth,
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
            ]);

            \DB::commit();

            return $this->getOneDoctor($healthP->id);
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
                'company',
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        } else {
            $healthProfessionals = HealthProfessional::whereHas('billingCompanies', function ($query) use ($bC) {
                $query->where('billing_company_id', $bC);
            })->with([
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
                'company',
            ]);
        } else {
            $data = HealthProfessional::whereHas('billingCompanies', function ($query) use ($bC) {
                $query->where('billing_company_id', $bC);
            })->with([
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

        $healthProfessionals = HealthProfessional::with('user.profile', 'companies');

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
            $healthProfessionals = HealthProfessional::with('user.profile', 'companies')->get();
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
                null
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
                            'name' => $healthProfessional->user->profile->first_name.' '.$healthProfessional->user->profile->last_name,
                        ]);
                    }
                    if (in_array($referred->id, $auth)) {
                        array_push($records['referred'], [
                            'id' => $healthProfessional->id,
                            'name' => $healthProfessional->user->profile->first_name.' '.$healthProfessional->user->profile->last_name,
                        ]);
                    }
                    if (in_array($service_provider->id, $auth)) {
                        array_push($records['service_provider'], [
                            'id' => $healthProfessional->id,
                            'name' => $healthProfessional->user->profile->first_name.' '.$healthProfessional->user->profile->last_name,
                        ]);
                    }
                }
            } else {
                $field = [
                    'id' => $healthProfessional->id,
                    'name' => $healthProfessional->user->profile->first_name.' '.$healthProfessional->user->profile->last_name,
                ];
                if ($taxonomy == 'true') {
                    $field['taxonomies'] = $healthProfessional->taxonomies->map(fn ($item) => [
                        'id' => $item->id,
                        'tax_id' => $item->tax_id,
                        'name' => $item->name,
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
