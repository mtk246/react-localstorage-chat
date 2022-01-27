<?php

namespace App\Repositories;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\ImgProfileRequest;
use App\Http\Requests\UserCreateRequest;
use App\Mail\GenerateNewPassword;
use App\Mail\RecoveryUserMail;
use App\Mail\SendEmailRecoveryPassword;
use App\Models\BillingCompany;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class UserRepository{

    /**
     * @param UserCreateRequest $request
     * @return User|Model|null
     * @throws Throwable
     */
    public function create(UserCreateRequest $request){
        try{
            \DB::beginTransaction();
            $validated = $request->validated();

            $user = User::create($validated);

            if($request->has("company-billing")){
                $user->billingCompanyUser()->attach($request->input("company-billing"));
            }

            if( isset( $validated['roles'] ) )
                $user->assignRole($validated['roles']);

            $token = encrypt($user->id."@#@#$".$user->email);
            $user->token = $token;
            $user->save();

            \Mail::to($user->email)->send(
                new GenerateNewPassword(
                    $user->firstName.' '.$user->lastName,
                    $user->email,
                    env('URL_FRONT') . $token
                )
            );
            \DB::commit();;
            return $user;
        }catch (\Exception $e){
            \DB::rollBack();
            return null;
        }
    }

    /**
     * @param int $company_id
     * @return BillingCompany|Builder|Model|object|null
     */
    public function checkCompanyBilling(int $company_id){
        return BillingCompany::whereId($company_id)->first();
    }

    /**
     * @param string $email
     * @return User|Builder|Model|object|null
     */
    public function findUserByEmail(string $email){
        if( !$email ) return null;

        return User::whereEmail($email)->first();
    }

    /**
     * @return User[]|Collection
     */
    public function getAllUsers(){
        return User::get();
    }

    /**
     * @param string $email
     * @return bool|null
     */
    public function sendEmailToRescuePassword(string $email): ?bool
    {
        try{
            $user = $this->findUserByEmail($email);

            if( is_null($user) ) return null;

            $token = encrypt($user->id."@#@#$".$user->email);

            $user->token = $token;
            $user->save();

            $url = env("URL_FRONTEND") . $token;
            $fullName = $user->firstName ." ".$user->lastName;

            \Mail::to($user->email)->send(new SendEmailRecoveryPassword($fullName,$url));
        }catch (\Exception $e){
            dd($e);
        }

        return true;
    }

    /**
     * @param Request $request
     * @param string $token
     * @return bool|null
     */
    public function changePassword(Request $request,string $token): ?bool
    {
        try {
            $strData = \Crypt::decrypt($token);
            $dataSplit = explode("@#@#$",$strData);

            $user = User::where("token",$token)->where("email",$dataSplit[1])->first();

            if(is_null($user)) return null;

            $user->token = null;
            $user->password = bcrypt($request->input("password"));
            $user->save();
        }catch (\Exception $exception){
            return false;
        }

        return true;
    }

    /**
     * @param EditUserRequest $request
     * @param int $id
     * @return bool|int
     */
    public function editUser(EditUserRequest $request,int $id){
        $data = $request->validated();
        return User::whereId($id)->update($data);
    }

    /**
     * @param bool $status
     * @param int $id
     * @return bool|int
     */
    public function changeStatus(bool $status,int $id){
        return User::whereId($id)->update(['available' => $status]);
    }

    /**
     * @param int $id
     * @return User|Builder|Model|object|null
     */
    public function getOneUser(int $id){
        $user = User::whereId($id)->first();

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
     * @param string $email
     * @return bool|null
     */
    public function recoveryUser(string $email): ?bool
    {
        $user = User::whereEmail($email)->first();

        if(is_null($user)) return null;

        $token = encrypt($user->id."@#@#$".$user->email);

        $user->token = $token;
        $user->save();

        Mail::to($user->email)->send(
            new RecoveryUserMail(
            $user->firstName.' '.$user->lastName,
            $user->email,
            env('URL_FRONT') . $token)
        );
        return true;
    }

    public function changePasswordForm(string $password){
        return User::whereId(auth()->id())->update(["password" => bcrypt($password)]);
    }
}
