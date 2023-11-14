<?php

namespace App\Repositories;

use App\Enums\User\UserType;
use App\Events\User\UpdatePasswordEvent;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\ImgProfileRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\User\UserResource;
use App\Mail\GenerateNewPassword;
use App\Mail\SendEmailChangePassword;
use App\Mail\SendEmailRecoveryPassword;
use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\Contact;
use App\Models\Profile;
use App\Models\SocialMedia;
use App\Models\SocialNetwork;
use App\Models\TypeCatalog;
use App\Models\User;
use App\Roles\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Resource_;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * @param UserCreateRequest $request
     *
     * @return User|Model|null
     */
    public function create(array $data)
    {
        try {
            DB::beginTransaction();

            /** Create Profile */
            $profile = Profile::updateOrCreate([
                'ssn' => $data['profile']['ssn'],
            ], [
                'ssn' => $data['profile']['ssn'],
                'first_name' => $data['profile']['first_name'],
                'middle_name' => $data['profile']['middle_name'],
                'last_name' => $data['profile']['last_name'],
                'sex' => $data['profile']['sex'],
                'date_of_birth' => $data['profile']['date_of_birth'],
            ]);

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
                        ], [
                            'link' => $socialMedia['link'],
                        ]);
                    }
                }
            }

            /** Create User */
            $user = User::create([
                'usercode' => generateNewCode('US', 5, date('Y'), User::class, 'usercode'),
                'email' => $data['email'],
                'language' => $data['language'] ?? 'en',
                'status' => true,
                'userkey' => encrypt(uniqid('', true)),
                'profile_id' => $profile->id,
            ]);

            /* Attach billing company */
            if (isset($data['billing_company_id'])) {
                $user->billingCompanies()->attach($data['billing_company_id']);
            }

            /* Attach Role and permission */
            if (isset($data['roles'])) {
                $roles = [];
                foreach ($data['roles'] as $role) {
                    $rol = Role::whereName($role)->first();
                    if (isset($rol)) {
                        array_push($roles, $rol->id);
                        $permissions = $rol->permissions;
                        foreach ($permissions as $perm) {
                            $user->attachPermission($perm);
                        }
                    }
                }
                $user->syncRoles($roles);
            }

            if (isset($data['contact'])) {
                $data['contact']['contactable_id'] = $user->id;
                $data['contact']['contactable_type'] = User::class;
                $data['contact']['billing_company_id'] = $data['billing_company_id'] ?? null;
                Contact::create($data['contact']);
            }

            if (isset($data['address'])) {
                $data['address']['addressable_id'] = $user->id;
                $data['address']['addressable_type'] = User::class;
                $data['address']['billing_company_id'] = $data['billing_company_id'] ?? null;
                Address::create($data['address']);
            }

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

            DB::commit();

            return new UserResource($user);
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    /**
     * @return BillingCompany|Builder|Model|object|null
     */
    public function checkCompanyBilling(int $company_id)
    {
        return BillingCompany::whereId($company_id)->first();
    }

    /**
     * @return User|Builder|Model|object|null
     */
    public function findUserByEmail(string $email)
    {
        if (!$email) {
            return null;
        }

        return User::whereEmail($email)->first();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllUsers()
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $users = User::with([
                'profile',
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        } else {
            $users = User::whereHas('billingCompanies', function ($query) use ($bC) {
                $query->where('billing_company_id', $bC);
            })->with([
                'profile',
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        }

        return UserResource::collection($users);
    }

    public function getServerAllUsers(Request $request)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = User::query()->with([
                'profile',
            ]);
        } else {
            $data = User::query()->whereHas('billingCompanies', function ($query) use ($bC) {
                $query->where('billing_company_id', $bC);
            })->with([
                'profile',
            ]);
        }
        if (!empty($request->query('query')) && '{}' !== $request->query('query')) {
            $data = $data->search($request->query('query'));
        }
        if ($request->sortBy) {
            if (str_contains($request->sortBy, 'role')) {
                $data = $data->orderBy('id', (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
                /**$data = $data->orderBy(Role::select('name')
                        ->join('role_user', 'role_user.role_id', '=', 'roles.id')
                        ->whereColumn('role_user.user_id', 'users.id'), (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');*/
            } elseif (str_contains($request->sortBy, 'name')) {
                $data = $data->orderBy(
                    Profile::select('first_name')->whereColumn('profiles.id', 'users.profile_id'), (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } else {
                $data = $data->orderBy($request->sortBy, (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
            }
        } else {
            $data = $data->orderBy('created_at', 'desc')->orderBy('id', 'asc');
        }

        $data = $data->paginate($request->itemsPerPage);

        return UserResource::collection($data)->resource;
    }

    /**
     * @return bool|null
     */
    public function sendEmailToRescuePassword(string $email)
    {
        try {
            $user = $this->findUserByEmail($email);

            if (is_null($user)) {
                return null;
            }

            $token = encrypt($user->id.'@#@#$'.$user->email);

            $user->token = $token;
            $user->save();

            $url = env('URL_FRONT').'/#/newCredentials?mcctoken='.$token;
            $fullName = $user->profile->first_name.' '.$user->profile->last_name;

            Mail::to($user->email)->send(new SendEmailRecoveryPassword($fullName, $url));
        } catch (\Exception $e) {
            return null;
        }

        return true;
    }

    /**
     * @return bool|null
     */
    public function changePassword(Request $request, string $token)
    {
        try {
            $strData = \Crypt::decrypt($token);
            $dataSplit = explode('@#@#$', $strData);

            $user = User::where('token', $token)->where('email', $dataSplit[1])->first();

            if (is_null($user)) {
                return null;
            }

            $user->token = null;
            $user->password = bcrypt($request->input('password'));
            $user->save();

            $url = env('URL_FRONT').'/#/';
            $fullName = $user->profile->first_name.' '.$user->profile->last_name;

            Mail::to($user->email)->send(new SendEmailChangePassword($fullName, $url));
            event(new UpdatePasswordEvent($user, $request->input('password')));
        } catch (\Exception $exception) {
            return false;
        }

        return true;
    }

    public function newToken(string $token)
    {
        try {
            $strData = \Crypt::decrypt($token);
            $dataSplit = explode('@#@#$', $strData);
            $user = User::where('email', $dataSplit[1])->first();

            if (is_null($user)) {
                return null;
            }

            $token = encrypt($user->id.'@#@#$'.$user->email);
            $user->token = $token;
            $user->save();
            $profile = $user->profile;

            $url = env('URL_FRONT').'/#/newCredentials?mcctoken='.$token;
            $fullName = $profile->first_name.' '.$profile->last_name;

            Mail::to($user->email)->send(new SendEmailRecoveryPassword($fullName, $url));
        } catch (\Exception $exception) {
            return false;
        }

        return true;
    }

    /**
     * @param EditUserRequest $request
     *
     * @return User|User[]|Collection|Model|null
     */
    public function editUser(array $data, int $id)
    {
        $user = User::query()->find($id);
        if (is_null($user)) {
            return null;
        }

        $profile = $user->profile;
        /* Create Profile */
        $profile->update([
            'ssn' => $data['profile']['ssn'],
            'first_name' => $data['profile']['first_name'],
            'middle_name' => $data['profile']['middle_name'],
            'last_name' => $data['profile']['last_name'],
            'sex' => $data['profile']['sex'],
            'date_of_birth' => $data['profile']['date_of_birth'],
        ]);

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
                    ], [
                        'link' => $socialMedia['link'],
                    ]);
                }
            }
        }

        /* Update User */
        $user->update([
            'email' => $data['email'],
            'language' => $data['language'] ?? $user->language,
        ]);

        /* Attach billing company */
        if (isset($data['billing_company_id'])) {
            $user->billingCompanies()->sync($data['billing_company_id']);
        }

        $user->detachAllPermissions();
        $user->detachAllRoles();

        /* Attach billing company */
        if (isset($data['roles'])) {
            $roles = [];
            foreach ($data['roles'] as $role) {
                $rol = Role::whereName($role)->first();
                if (isset($rol)) {
                    array_push($roles, $rol->id);
                    $permissions = $rol->permissions;
                    foreach ($permissions as $perm) {
                        $user->attachPermission($perm);
                    }
                }
            }
            $user->syncRoles($roles);
        }

        if (isset($data['contact'])) {
            $data['contact']['email'] = $data['email'];
            $data['contact']['billing_company_id'] = $data['billing_company_id'] ?? null;
            Contact::updateOrCreate([
                'contactable_id' => $user->id,
                'contactable_type' => User::class,
            ], $data['contact']);
        }

        if (isset($data['address'])) {
            $data['address']['billing_company_id'] = $data['billing_company_id'] ?? null;
            Address::updateOrCreate([
                'addressable_id' => $user->id,
                'addressable_type' => User::class,
            ], $data['address']);
        }

        return  new UserResource($user->refresh()->load('profile'));
    }

    /**
     * @return bool|int
     */
    public function changeStatus(bool $status, int $id)
    {
        return User::whereId($id)->update(['status' => $status]);
    }

    public function getOneUser(User $user)
    {
        $bC = $user->billing_company_id ?? null;

        if (!$bC) {
            $user = $user->load([
                'profile' => function ($query) {
                    $query->with(['socialMedias', 'addresses', 'contacts']);
                },
                'billingCompanies',
            ]);
        } else {
            $user = $user = $user->load([
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
            ]);
        }

        return new UserResource($user);
    }

    public function updateImgProfile(ImgProfileRequest $request): string
    {
        if (!file_exists(public_path('/img-profile'))) {
            mkdir(public_path('/img-profile/'));
        }

        $file = $request->file('img');
        $fullNameFile = strtotime('now').$file->getClientOriginalExtension();
        $file->move(public_path('/img-profile/'), $fullNameFile);

        $pathNameFile = asset('/img-profile/'.$fullNameFile);

        $user = User::whereId(auth()->id())->first();
        $user->profile->update([
            'avatar' => $pathNameFile,
        ]);

        return $pathNameFile;
    }

    /**
     * @return Builder[]|Collection
     */
    public function getListSocialNetworks()
    {
        try {
            return getList(SocialNetwork::class, 'name', ['active' => true]);
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @return Builder[]|Collection
     */
    public function getList(Request $request)
    {
        $records = [];
        $billingCompanyId = $request->billing_company_id ?? null;
        $authorization = $request->authorization ?? null;

        if (auth()->user()->hasRole('superuser')) {
            $billingCompany = $billingCompanyId;
        } else {
            $billingCompany = auth()->user()->billingCompanies->first();
        }

        $users = User::with('profile');

        if (isset($billingCompany)) {
            $users = $users->whereHas('billingCompanies', function ($query) use ($billingCompany) {
                $query->where('billing_company_id', $billingCompany->id ?? $billingCompany)
                      ->where('billing_company_user.status', true);
            });
        }
        if (!isset($billingCompany)) {
            $users = User::with('profile')->get();
        } else {
            $users = $users->get();
        }

        foreach ($users as $user) {
            array_push($records, [
                'id' => $user->id,
                'name' => $user->profile->first_name.' '.
                          substr($user->profile->middle_name, 0, 1).' '.
                          $user->profile->last_name,
            ]);
        }

        return $records;
    }

    /**
     * @param EditUserRequest $request
     *
     * @return User|User[]|Collection|Model|null
     */
    public function updateSocialMediaProfile(array $data, int $id)
    {
        $user = User::find($id);
        $profile = $user->profile;

        $socialMedias = $profile->socialMedias;
        /* Delete socialMedia */
        foreach ($socialMedias as $socialMedia) {
            $validated = false;
            $socialNetwork = $socialMedia->SocialNetwork;
            if (isset($socialNetwork)) {
                foreach ($data['social_medias'] as $socialM) {
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
        foreach ($data['social_medias'] as $socialMedia) {
            $socialNetwork = SocialNetwork::whereName($socialMedia['name'])->first();
            if (isset($socialNetwork)) {
                SocialMedia::updateOrCreate([
                    'profile_id' => $profile->id,
                    'social_network_id' => $socialNetwork->id,
                ], [
                    'link' => $socialMedia['link'],
                ]);
            }
        }

        return $user->refresh()->load('profile', 'profile.socialMedias');
    }

    /**
     * @return string|null
     */
    public function recoveryUser(Request $request)
    {
        $ssn = $request->ssn;
        $ssnFormated = substr($ssn, 0, 1).'-'.substr($ssn, 1, strlen($ssn));
        $profile = Profile::query()
            ->where('ssn', 'LIKE', "%{$ssn}")
            ->orWhere('ssn', 'LIKE', "%{$ssnFormated}")
            ->whereDateOfBirth($request->dateOfBirth)->first();

        $user = User::where('profile_id', $profile->id)->first();

        if (is_null($user)) {
            return null;
        }

        $emailFormated = explode('@', $user->email);
        $this->sendEmailToRescuePassword($user->email);

        return middleRedactor($emailFormated[0], '*').'@'.middleRedactor($emailFormated[1], '*');
    }

    public function changePasswordForm(string $password)
    {
        $user = User::whereId(auth()->id())->first();
        $user->update(['password' => bcrypt($password)]);

        $url = env('URL_FRONT').'/#/';
        $fullName = $user->profile->first_name.' '.$user->profile->last_name;

        Mail::to($user->email)->send(new SendEmailChangePassword($fullName, $url));

        return $user;
    }

    public function unlockUser(Request $request)
    {
        $user = User::whereEmail(strtolower($request->email))->first();

        if (is_null($user)) {
            return null;
        }
        $code = \Crypt::decrypt($user->usercode);
        if ($code == $request->usercode) {
            $user->isBlocked = false;
            $user->save();

            // Get the token
            $token = auth()->login($user);

            return response()->json([
                'user' => $user->load(['billingCompanies', 'permits']),
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
            ]);
        }

        return null;
    }

    /**
     * @return User|Builder|Model|object|null
     */
    public function searchBySsn(string $ssn, ?int $billing_company_id = null)
    {

        $bC = Gate::check('is-admin') ? $billing_company_id : auth()->user()->billing_company_id;
        $user = User::with([
            'profile' => function ($query) use ($bC) {
                $query->with([
                    'socialMedias',
                    'addresses' => function ($query) use ($bC) {
                        if (!empty($bC)) {
                            $query->where('billing_company_id', $bC);
                        }
                    },
                    'contacts' => function ($query) use ($bC) {
                        if (!empty($bC)) {
                            $query->where('billing_company_id', $bC);
                        }
                    },
                ]);
            },
            'billingCompanies',
        ])->whereHas('profile', function ($query) use ($ssn) {
            $query->where('ssn', $ssn)
                ->orWhere('ssn', str_replace('-', '', $ssn ?? ''));
        })->whereHas('billingCompanies', function ($query) use ($bC) {
            if (!empty($bC)) {
                $query->where('billing_company_id', $bC);
            }
        })->first();

        return $user;
    }

    public function search(Request $request)
    {
        $email = strtolower($request->get('email'));

        $bC = auth()->user()->billing_company_id ?? null;

        if (User::query()->where('email', $email)->whereNot('type', UserType::BILLING)->exists()) {
            return null;
        }

        if (!$bC) {
            $profile = Profile::query()
                ->with(['user', 'socialMedias', 'addresses', 'contacts'])
                ->whereHas('contacts', function (Builder $query) use ($email) {
                    $query->where('email', $email);
                })
                ->get();
        } else {
            $profile = Profile::query()
                ->with([
                    'user',
                    'socialMedias',
                    'addresses' => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    'contacts' => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    }
                ])
                ->whereHas('contacts', function (Builder $query) use ($email) {
                    $query->where('email', $email);
                })
                ->get();
        }

        return $profile;
    }

    public function updateLang(string $lang)
    {
        $user = User::whereId(auth()->id())->first();
        $user->update([
            'language' => $lang,
        ]);

        return $user;
    }

    public function getListLangs()
    {
        try {
            return [
                ['id' => 1, 'code' => 'en', 'name' => 'English'],
                ['id' => 2, 'code' => 'es', 'name' => 'Spanish'],
            ];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListNameSuffix()
    {
        try {
            return getList(TypeCatalog::class, ['description'], ['relationship' => 'type', 'where' => ['description' => 'Name suffix']], null);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListGender()
    {
        try {
            return getList(TypeCatalog::class, ['description'], ['relationship' => 'type', 'where' => ['description' => 'Gender']], null, ['code']);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function updatePassword($data)
    {
        try {
            $user = User::whereId(auth()->id())->first();

            if ($user && Hash::check($data['current_password'], $user->password)) {
                $user->update([
                    'password' => bcrypt($data['password']),
                ]);
            } else {
                return null;
            }

            return $user;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
