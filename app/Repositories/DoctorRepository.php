<?php

namespace App\Repositories;

use App\Mail\GenerateNewPassword;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DoctorRepository
{
    public function createDoctor(array $data)
    {
        try{
            \DB::beginTransaction();
            $user = User::create($data['user']);
            $data["address"]['user_id'] = $user->id;
            Address::create($data["address"]);
            $data["contact"]['user_id'] = $user->id;
            Contact::create($data['contact']);
            $data['doctor']['user_id']  = $user->id;
            $doc = Doctor::create($data["doctor"]);

            if(!is_null($doc) && !is_null($user)){
                $user->assignRole("DOCTOR");

                $token = encrypt($user->id."@#@#$".$user->email);
                $user->token = $token;
                $user->save();

                \Mail::to($user->email)->send(new GenerateNewPassword(
                    $user->firstName." ".$user->lastName,
                    $user->email,
                        env('URL_FRONT') . $token
                    )
                );
            }else{
                \DB::rollBack();
                return null;
            }

            \DB::commit();
            return $user->load("doctor");
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
    public function updateDoc(array $data,int $id){
        if(isset($data['user'])){
            $user = User::find($id);

            if($user->email == $data['user']['email'])
                unset($data['user']['email']);

            if($user->username == $data['user']['username'])
                unset($data['user']['username']);

            if($user->ssn == $data['user']['ssn'])
                unset($data['user']['username']);

            User::whereId($id)->update($data['user']);
        }

        if(isset($data['address'])){
            $address = Address::whereUserId($id)->first();

            if( is_null($address) ){
                $data["address"]["user_id"] = $id;
                Address::create($data["address"]);
            }else{
                Address::whereUserId($id)->update($data["address"]);
            }

        }

        if(isset($data['doctor'])){
            $doctor = Doctor::whereUserId($id)->first();

            if( is_null($doctor) ){
                $data["doctor"]["user_id"] = $id;
                Doctor::create($data["doctor"]);
            }else{
                $doctor = Doctor::whereId($id)->first();

                if($doctor->npi == $data['doctor']['npi']){
                    unset($data['doctor']['npi']);
                }

                Doctor::whereId($id)->update($data["doctor"]);
            }
        }


        if(isset($data['contact'])){
            $contact = Contact::whereUserId($id)->first();

            if( is_null($contact) ){
                $data["contact"]["user_id"] = $id;
                Contact::create($data["contact"]);
            }else{
                Contact::whereUserId($id)->update($data["contact"]);
            }
        }

        return User::whereId($id)->with("doctor")->first();
    }

    /**
     * @return Collection|Doctor[]
     */
    public function getAllDoctors(){
        return Doctor::with("user")->get();
    }

    /**
     * @param int $id
     * @return Doctor|Builder|Model|object|null
     */
    public function getOneDoctor(int $id){
        $doc = Doctor::whereId($id)->with("user")->first();

        if(is_null($doc)) return null;

        return $doc;
    }

    /**
     * @param string $npi
     * @return Doctor|Builder|Model|object|null
     */
    public function getOneByNpi(string $npi){
        $doc = Doctor::whereNpi($npi)->with("user")->first();

        if(is_null($doc)) return null;

        return $doc;
    }
}
