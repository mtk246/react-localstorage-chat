<?php

namespace App\Repositories;

use App\Http\Requests\UserCreateRequest;
use App\Mail\SendEmailRecoveryPassword;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class UserRepository{

    /**
     * @return User|Model
     * @var $request UserCreateRequest
     */
    public function create(UserCreateRequest $request){
        $validated = $request->validated();

        $user = User::create($validated);

        if( isset( $validated['roles'] ) )
            $user->assignRole($validated['roles']);

        return $user;
    }

    /**
     * @param $email
     * @return User|Builder|Model|object|null
     */
    public function findUserByEmail($email){
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
     * @param $email
     * @return bool|null
     */
    public function sendEmailToRescuePassword($email): ?bool
    {
        try{
            $user = $this->findUserByEmail($email);

            if( is_null($user) ) return null;

            $token = encrypt($user->id."@#@#$".$user->email);

            $user->token = $token;
            $user->save();

            $url = env("URL_FRONTEND") . "change-password/" . $token;
            $fullName = $user->firstName ." ".$user->lastName;

            \Mail::to($user->email)->send(new SendEmailRecoveryPassword($fullName,$url));
        }catch (\Exception $e){
            return false;
        }

        return true;
    }

    /**
     * @param Request $request
     * @param $token
     * @return bool|null
     */
    public function changePassword(Request $request,$token): ?bool
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
}
