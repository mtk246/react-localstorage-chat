<?php

namespace App\Repositories;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\ImgProfileRequest;
use App\Http\Requests\UserCreateRequest;
use App\Mail\GenerateNewPassword;
use App\Mail\RecoveryUserMail;
use App\Mail\SendEmailRecoveryPassword;
use App\Mail\SendEmailChangePassword;
use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\Contact;
use App\Models\User;
use App\Models\Profile;
use App\Models\SocialMedia;
use App\Models\SocialNetwork;
use App\Roles\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;
use Illuminate\Support\Facades\DB;

class UserRepository{

    /**
     * @param UserCreateRequest $request
     * @return User|Model|null
     */
    public function create(array $data) {
        try {
            DB::beginTransaction();

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
                "language"   => $data['language'],
                "status"     => true,
                "userkey"    => encrypt(uniqid("", true)),
                "profile_id" => $profile->id
            ]);

            /** Attach billing company */
            if (isset($data['company-billing'])) {
                $user->billingCompanies()->attach($data["company-billing"]);
            }

            /** Attach Role and permission */
            if (isset($data['roles'])) {
                $roles = [];
                foreach ($data['roles'] as $role) {
                    $rol = Role::whereName($role)->first();
                    if (isset($rol)) {
                        array_push($roles, $rol->id);
                        $permissions = $rol->permissions;
                        foreach($permissions as $perm) {
                            $user->attachPermission($perm);

                        }
                    }
                }
                $user->syncRoles($roles);
            }

            if (isset($data['contact'])) {
                $data["contact"]["contactable_id"]     = $user->id;
                $data["contact"]["contactable_type"]   = User::class;
                $data["contact"]["billing_company_id"] = $data["company-billing"] ?? null;
                Contact::create($data["contact"]);
            }

            if (isset($data['address'])) {
                $data["address"]["addressable_id"]     = $user->id;
                $data["address"]["addressable_type"]   = User::class;
                $data["address"]["billing_company_id"] = $data["company-billing"] ?? null;
                Address::create($data["address"]);
            }

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

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param int $company_id
     * @return BillingCompany|Builder|Model|object|null
     */
    public function checkCompanyBilling(int $company_id) {
        return BillingCompany::whereId($company_id)->first();
    }

    /**
     * @param string $email
     * @return User|Builder|Model|object|null
     */
    public function findUserByEmail(string $email) {
        if (!$email) return null;

        return User::whereEmail($email)->first();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllUsers() {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $users = User::with([
                "profile",
                "roles"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        } else {
            $users = User::whereHas("billingCompanies", function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                })->with([
                    "profile",
                    "roles"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        }

        return is_null($users) ? null : $users;
    }

    public function getServerAllUsers(Request $request) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = User::with([
                "profile",
                "roles"
            ]);
        } else {
            $data = User::whereHas("billingCompanies", function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                })->with([
                    "profile",
                    "roles"
            ]);
        }
        if (!empty($request->query('query')) && $request->query('query')!=="{}") {
            $data = $data->search($request->query('query'));
        }
        if ($request->sortBy) {
            if (str_contains($request->sortBy, 'role')) {
                $data = $data->orderBy('id', (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
                /**$data = $data->orderBy(Role::select('name')
                        ->join('role_user', 'role_user.role_id', '=', 'roles.id')
                        ->whereColumn('role_user.user_id', 'users.id'), (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');*/
            } elseif (str_contains($request->sortBy, 'name')) {
                $data = $data->orderBy(
                    Profile::select('first_name')->whereColumn('profiles.id', 'users.profile_id'), (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } else {
                $data = $data->orderBy($request->sortBy, (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            }
        } else {
            $data = $data->orderBy("created_at", "desc")->orderBy("id", "asc");
        }

        $data = $data->paginate($request->itemsPerPage);

        return response()->json([
            'data'          => $data->items(),
            'numberOfPages' => $data->lastPage(),
            'count'         => $data->total()
        ], 200);
    }

    /**
     * @param string $email
     * @return bool|null
     */
    public function sendEmailToRescuePassword(string $email)
    {
        try {
            $user = $this->findUserByEmail($email);

            if (is_null($user)) return null;

            $token = encrypt($user->id."@#@#$".$user->email);

            $user->token = $token;
            $user->save();

            $url = env('URL_FRONT') . "/#/newCredentials?mcctoken=" . $token;
            $fullName = $user->profile->first_name . " " . $user->profile->last_name;

            Mail::to($user->email)->send(new SendEmailRecoveryPassword($fullName, $url));
        } catch (\Exception $e) {
            return null;
        }

        return true;
    }

    /**
     * @param Request $request
     * @param string $token
     * @return bool|null
     */
    public function changePassword(Request $request, string $token)
    {
        try {
            $strData = \Crypt::decrypt($token);
            $dataSplit = explode("@#@#$",$strData);

            $user = User::where("token", $token)->where("email", $dataSplit[1])->first();

            if (is_null($user)) return null;

            $user->token = null;
            $user->password = bcrypt($request->input("password"));
            $user->save();

            $url = env('URL_FRONT') . "/#/";
            $fullName = $user->profile->first_name . " " . $user->profile->last_name;

            Mail::to($user->email)->send(new SendEmailChangePassword($fullName, $url));
        }catch (\Exception $exception) {
            return false;
        }

        return true;
    }

    public function newToken(string $token)
    {
        try {

            $strData = \Crypt::decrypt($token);
            $dataSplit = explode("@#@#$",$strData);
            $user = User::where("email", $dataSplit[1])->first();

            if (is_null($user)) return null;

            $token = encrypt($user->id."@#@#$".$user->email);
            $user->token = $token;
            $user->save();
            $profile = $user->profile;

            $url = env('URL_FRONT') . "/#/newCredentials?mcctoken=" . $token;
            $fullName = $profile->first_name . " " . $profile->last_name;

            Mail::to($user->email)->send(new SendEmailRecoveryPassword($fullName, $url));
        } catch (\Exception $exception) {
            return false;
        }

        return true;
    }

    /**
     * @param EditUserRequest $request
     * @param int $id
     * @return User|User[]|Collection|Model|null
     */
    public function editUser(array $data, int $id) {
        $user = User::find($id);
        $profile = $user->profile;
        /** Create Profile */
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

        /** Update User */
        $user->update([
            "email"    => $data['email'],
            "language" => $data['language'],
        ]);

        /** Attach billing company */
        if (isset($data['company-billing'])) {
            $user->billingCompanies()->sync($data["company-billing"]);
        }
        
        $user->detachAllPermissions();
        $user->detachAllRoles();

        /** Attach billing company */
        if (isset($data['roles'])) {
            $roles = [];
            foreach ($data['roles'] as $role) {
                $rol = Role::whereName($role)->first();
                if (isset($rol)) {
                    array_push($roles, $rol->id);
                    $permissions = $rol->permissions;
                    foreach($permissions as $perm) {
                        $user->attachPermission($perm);

                    }
                }
            }
            $user->syncRoles($roles);
        }

        if (isset($data['contact'])) {
            $data["contact"]["email"] = $data['email'];
            $data["contact"]["billing_company_id"] =  $data["company-billing"] ?? null;
            Contact::updateOrCreate([
                "contactable_id"     => $user->id,
                "contactable_type"   => User::class
            ], $data['contact']);
        }

        if (isset($data['address'])) {
            $data["address"]["billing_company_id"] = $data["company-billing"] ?? null;
            Address::updateOrCreate([
                "addressable_id"     => $user->id,
                "addressable_type"   => User::class
            ], $data["address"]);
        }

        return $user->refresh()->load("profile");
    }

    /**
     * @param bool $status
     * @param int $id
     * @return bool|int
     */
    public function changeStatus(bool $status, int $id) {
        return User::whereId($id)->update(['status' => $status]);
    }

    /**
     * @param int $id
     * @return User|Builder|Model|object|null
     */
    public function getOneUser(int $id) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $user = User::whereId($id)->with([
                "profile" => function ($query) {
                    $query->with('socialMedias');
                },
                "roles",
                "addresses",
                "contacts",
                "billingCompanies"
            ])->first();
        } else {
            $user = User::whereId($id)->with([
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
            ])->first();
        }

        return is_null($user) ? null : $user;
    }

    /**
     * @param ImgProfileRequest $request
     * @return string
     */
    public function updateImgProfile(ImgProfileRequest $request): string
    {
        if(!file_exists(public_path("/img-profile")))
            mkdir(public_path("/img-profile/"));

        $file = $request->file('img');
        $fullNameFile = strtotime('now') . $file->getClientOriginalExtension();
        $file->move(public_path("/img-profile/"),$fullNameFile);

        $pathNameFile = asset("/img-profile/" . $fullNameFile);

        $user = User::whereId(auth()->id())->first();
        $user->profile->update([
            'avatar' => $pathNameFile,
        ]);

        return $pathNameFile;
    }

    /**
     * @return Builder[]|Collection
     */
    public function getListSocialNetworks() {
        try {
            return getList(SocialNetwork::class, 'name', ['active' => true]);
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @param EditUserRequest $request
     * @param int $id
     * @return User|User[]|Collection|Model|null
     */
    public function updateSocialMediaProfile(array $data, int $id) {
        $user = User::find($id);
        $profile = $user->profile;

        $socialMedias = $profile->socialMedias;
        /** Delete socialMedia */
        foreach ($socialMedias as $socialMedia) {
            $validated = false;
            $socialNetwork = $socialMedia->SocialNetwork;
            if (isset($socialNetwork)) {
                foreach ($data["social_medias"] as $socialM) {
                    if ($socialM['name'] == $socialNetwork->name) {
                        $validated = true;
                        break;
                    }
                }
            }
            if (!$validated) $socialMedia->delete();
        }

        /** update or create new social medias */
        foreach ($data["social_medias"] as $socialMedia) {
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

        return $user->refresh()->load("profile", "profile.socialMedias");
    }

    /**
     * @param request $request
     * @return string|null
     */
    public function recoveryUser(Request $request)
    {
        $ssn = $request->ssn;
        $ssnFormated = substr($ssn, 0,1) . '-' . substr($ssn, 1, strlen($ssn));
        $profile = Profile::where("ssn", "ilike", "%${ssn}")
                          ->orWhere("ssn", "ilike", "%${ssnFormated}")
                          ->whereDateOfBirth($request->dateOfBirth)->first();

        $user = User::where('profile_id', $profile->id)->first();

        if (is_null($user)) return null;
        
        $emailFormated = explode("@", $user->email);
        $this->sendEmailToRescuePassword($user->email);
        return middleRedactor($emailFormated[0], '*') . "@" . middleRedactor($emailFormated[1], '*');
    }

    public function changePasswordForm(string $password) {
        $user = User::whereId(auth()->id())->first();
        $user->update(["password" => bcrypt($password)]);
        
        $url = env('URL_FRONT') . "/#/";
        $fullName = $user->profile->first_name . " " . $user->profile->last_name;

        Mail::to($user->email)->send(new SendEmailChangePassword($fullName, $url));
        return $user;
    }

    public function unlockUser(Request $request) {

        $user = User::whereEmail($request->email)->first();
        
        if (is_null($user)) return null;
        $code = \Crypt::decrypt($user->usercode);
        if ($code == $request->usercode) {
            $user->isBlocked = false;
            $user->save();

            // Get the token
            $token = auth()->login($user);
            return response()->json([
                'user'         => $user->load("permissions")->load("roles"),
                'access_token' => $token,
                'token_type'   => 'bearer',
                'expires_in'   => auth()->factory()->getTTL() * 60
            ]);
        }
        return null;
    }

    /**
     * @param string $ssn
     * @return User|Builder|Model|object|null
     */
    public function searchBySsn(string $ssn) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $user = User::with([
                "profile" => function ($query) {
                    $query->with('socialMedias');
                },
                "roles",
                "addresses",
                "contacts",
                "billingCompanies"
            ])->whereHas('profile', function ($query) use ($ssn) {
                $query->where("ssn", $ssn);
            })->first();
        } else {
            $user = User::with([
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
            ])->whereHas('profile', function ($query) use ($ssn) {
                $query->where("ssn", $ssn);
            })->first();
        }
        return $user;
    }

    public function search(Request $request) {
        $date_of_birth = $request->date_of_birth ?? '';
        $first_name = upperCaseWords($request->first_name ?? '');
        $last_name = upperCaseWords($request->last_name ?? '');
        $ssn = $request->ssn ?? '';
        $ssnFormated = substr($ssn, 0,1) . '-' . substr($ssn, 1, strlen($ssn));

        $bC = auth()->user()->billing_company_id ?? null;

        if (!$bC) {
            $users = User::with([
                "profile" => function ($query) {
                    $query->with('socialMedias');
                },
                "roles",
                "addresses",
                "contacts",
                "billingCompanies"
            ])->whereHas('profile', function ($query) use ($ssn, $ssnFormated, $date_of_birth, $first_name, $last_name) {
                $query->whereDateOfBirth($date_of_birth)
                      ->whereFirstName($first_name)
                      ->whereLastName($last_name)
                      ->where("ssn", "ilike", "%${ssn}")
                      ->orWhere("ssn", "ilike", "%${ssnFormated}");
            })->get();
        } else {
            $users = User::with([
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
            ])->whereHas('profile', function ($query) use ($ssn, $ssnFormated, $date_of_birth, $first_name, $last_name) {
                $query->whereDateOfBirth($date_of_birth)
                      ->whereFirstName($first_name)
                      ->whereLastName($last_name)
                      ->where("ssn", "ilike", "%${ssn}")
                      ->orWhere("ssn", "ilike", "%${ssnFormated}");
            })->get();
        }
        return (count($users) == 0) ? null : $users;
    }

    public function updateLang(string $lang)
    {
        $user = User::whereId(auth()->id())->first();
        $user->update([
            'language' => $lang,
        ]);
        return $user;
    }
}
