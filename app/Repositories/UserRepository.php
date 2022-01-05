<?php

namespace App\Repositories;

use App\Http\Requests\EditUserRequest;
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

            $url = env("URL_FRONTEND") . "change-password/" . $token;
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
}
