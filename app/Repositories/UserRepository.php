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
    public function create(UserCreateRequest $request) {
        try {
            DB::beginTransaction();
            $validated = $request->validated();

            $user = User::create([
                "username"    => $validated['username'],
                "email"       => $validated['email'],
                "sex"         => $validated['sex'],
                "firstName"   => $validated['firstName'],
                "lastName"    => $validated['lastName'],
                "middleName"  => $validated['middleName'],
                "ssn"         => $validated['ssn'],
                "dateOfBirth" => $validated['dateOfBirth'],
                "usercode"    => encrypt(uniqid("", true))
            ]);

            if ($request->has("company-billing")) {
                $user->billingCompanyUser()->attach($request->input("company-billing"));
            }

            if (isset($validated['roles']))
                $user->assignRole($validated['roles']);

            if (isset($validated['contact'])) {
                $validated["contact"]["user_id"] = $user->id;
                Contact::create($validated["contact"]);
            }

            if (isset($validated['address'])) {
                $validated["address"]["user_id"] = $user->id;
                Address::create($validated["address"]);
            }

            $token = encrypt($user->id."@#@#$".$user->email);
            $user->token = $token;
            $user->save();

            Mail::to($user->email)->send(
                new GenerateNewPassword(
                    $user->firstName.' '.$user->lastName,
                    $user->email,
                    \Crypt::decrypt($user->usercode),
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
        return User::with([
            "roles",
            "address",
            "contact",
            "billingCompanyUser"
        ])->get();
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
            $fullName = $user->firstName . " " . $user->lastName;

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

    /**
     * @param EditUserRequest $request
     * @param int $id
     * @return User|User[]|Collection|Model|null
     */
    public function editUser(EditUserRequest $request, int $id) {
        $data = $request->validated();

        $user = User::find($id);
        $user->update([
            "username"    => $data['username'],
            "email"       => $data['email'],
            "sex"         => $data['sex'],
            "firstName"   => $data['firstName'],
            "lastName"    => $data['lastName'],
            "middleName"  => $data['middleName'],
            "ssn"         => $data['ssn'],
            "dateOfBirth" => $data['dateOfBirth'],
        ]);
        
        if ($request->has("company-billing")) {
            $user->billingCompanyUser()->sync($data["company-billing"]);
        }

        if (isset($data['roles']))
            $user->syncRoles($data['roles']);

        if ($request->has('contact')) {
            $data["contact"]["email"] = $data['email'];
            Contact::updateOrCreate([
                "user_id" => $user->id
            ], $data['contact']);
        }

        if ($request->has('address')) {
            Address::updateOrCreate([
                "user_id" => $user->id
            ], $data["address"]);
        }
        return $user->refresh()->load("contact")->load("address");
    }

    /**
     * @param bool $status
     * @param int $id
     * @return bool|int
     */
    public function changeStatus(bool $status, int $id) {
        return User::whereId($id)->update(['available' => $status]);
    }

    /**
     * @param int $id
     * @return User|Builder|Model|object|null
     */
    public function getOneUser(int $id) {
        $user = User::whereId($id)->with([
            "roles",
            "address",
            "contact",
            "billingCompanyUser"
        ])->first();

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

        User::whereId(auth()->id())->update([
            'img_profile' => $pathNameFile,
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
        $user = User::where("ssn", "ilike", "%${ssn}")
                    ->whereDateOfBirth($request->dateOfBirth)->first();
        return (!is_null($user)) ? $user->email : null;
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
        return User::whereSsn($ssn)->first();
    }
}
