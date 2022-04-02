<?php

namespace App\Repositories;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\ImgProfileRequest;
use App\Http\Requests\UserCreateRequest;
use App\Mail\GenerateNewPassword;
use App\Mail\RecoveryUserMail;
use App\Mail\SendEmailRecoveryPassword;
use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\Contact;
use App\Models\User;
use App\Models\Profile;
use App\Models\SocialMedia;
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

            $socialMedias = $profile->socialMedias;
            /** Delete socialMedia */
            foreach ($socialMedias as $socialMedia) {
                $validated = false;
                foreach ($data["profile"]["social_medias"] as $socialM) {
                    if ($socialM['name'] == $socialMedia->name) {
                        $validated = true;
                        break;
                    }
                }
                if (!$validated) $socialMedia->delete();
            }

            /** update or create new social medias */
            foreach ($data["profile"]["social_medias"] as $socialMedia) {
                SocialMedia::updateOrCreate([
                    "name" => $socialMedia["name"]
                ], [
                    "name" => $socialMedia["name"],
                    "link" => $socialMedia["link"],
                    "profile_id" => $profile->id
                ]);
            }
            /** Create User */
            $user = User::create([
                "usercode"   => generateNewCode("US", 5, date("Y"), User::class, "usercode"),
                "email"      => $data['email'],
                "userkey"    => encrypt(uniqid("", true)),
                "profile_id" => $profile->id
            ]);

            /** Attach billing company */
            if (isset($data['company-billing'])) {
                $user->billingCompanies()->attach($data["company-billing"]);
            }

            /** Attach billing company */
            if (isset($data['roles']))
                $user->assignRole($data['roles']);

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
                    env('URL_FRONT') . "/newPassword?mcctoken=" . $token
                )
            );

            DB::commit();
            return $user;
        }catch (\Exception $e) {
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

            $url = env("URL_FRONT") . "/newCredentials?mcctoken=" . $token;
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

            $url = env("URL_FRONT") . "/newCredentials?mcctoken=" . $token;
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

        $socialMedias = $profile->socialMedias;
        /** Delete socialMedia */
        foreach ($socialMedias as $socialMedia) {
            $validated = false;
            foreach ($data["profile"]["social_medias"] as $socialM) {
                if ($socialM['name'] == $socialMedia->name) {
                    $validated = true;
                    break;
                }
            }
            if (!$validated) $socialMedia->delete();
        }

        /** update or create new social medias */
        foreach ($data["profile"]["social_medias"] as $socialMedia) {
            SocialMedia::updateOrCreate([
                "name" => $socialMedia["name"]
            ], [
                "name" => $socialMedia["name"],
                "link" => $socialMedia["link"],
                "profile_id" => $profile->id
            ]);
        }

        /** Update User */
        $user->update([
            "email" => $data['email'],
        ]);

        /** Attach billing company */
        if (isset($data['company-billing'])) {
            $user->billingCompanies()->sync($data["company-billing"]);
        }

        /** Attach billing company */
        if (isset($data['roles']))
            $user->syncRoles($data['roles']);

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
        return User::whereId(auth()->id())->update(["password" => bcrypt($password)]);
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
        $profile = Profile::where("ssn", $ssn)->first();
        $user = User::where('profile_id', $profile->id)->first();
        return $user;
    }
}
