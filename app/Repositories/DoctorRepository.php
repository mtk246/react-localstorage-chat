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
            $data["user"]["usercode"] = encrypt(uniqid("", true));
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
                    \Crypt::decrypt($user->usercode),
                    env('URL_FRONT') . "/newPassword?mcctoken=" . $token
                    )
                );
            }else{
                \DB::rollBack();
                return null;
            }

            \DB::commit();
            return $user->load("doctor", "address", "contact");
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
    public function updateDoc(array $data, int $id)
    {
        $doctor = Doctor::find($id);
        $doctor->update($data['doctor']);

        $user = $doctor->user;
        $user->update($data['user']);

        
        if (isset($data['address'])) {
            Address::updateOrCreate([
                'user_id' => $user->id
            ], $data['address']);
        }

        if (isset($data['contact'])) {
            Contact::updateOrCreate([
                'user_id' => $user->id
            ], $data['contact']);
        }

        return $user->refresh()->load('contact', 'address', 'doctor');
    }

    /**
     * @return Collection|Doctor[]
     */
    public function getAllDoctors(){
        return Doctor::with(["user.address","user.contact"])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
    }

    /**
     * @param int $id
     * @return Doctor|Builder|Model|object|null
     */
    public function getOneDoctor(int $id){
        $doc = Doctor::whereId($id)->with(["user.address","user.contact"])->first();

        if(is_null($doc)) return null;

        return $doc;
    }

    /**
     * @param string $npi
     * @return Doctor|Builder|Model|object|null
     */
    public function getOneByNpi(string $npi){
        $doc = Doctor::whereNpi($npi)->with(["user.address","user.contact"])->first();

        if(is_null($doc)) return null;

        return $doc;
    }

    /**
     * @param bool $status
     * @param int $id
     * @return bool|int|null
     */
    public function changeStatus(bool $status, int $id){
        $doctor = Doctor::whereId($id)->first();

        if( is_null($doctor) ) return null;

        return $doctor->update(["status" => $status]);
    }
}
