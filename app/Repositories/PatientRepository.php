<?php

namespace App\Repositories;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PatientRepository
{
    /**
     * @param array $data
     * @return User|Model|null
     */
    public function createPatient(array $data){
        try{
            DB::beginTransaction();

            $user = User::create($data["user"]);
            $data["patient"]['user_id'] = $user->id;
            $newPatient = Patient::create($data['patient']);

            if($user && $newPatient){
                $user->assignRole("PATIENT");
            }else{
                DB::rollBack();
                return null;
            }

        }catch(\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            return null;
        }

        DB::commit();
        return $user->load("patient");
    }

    /**
     * @param int $id
     * @return Patient|Builder|Model|object|null
     */
    public function getOnePatient(int $id){
        $patient = Patient::whereId($id)->with("user")->first();

        if(is_null($patient)) return null;

        return $patient;
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllPatient(){
        return Patient::with("user")->get();
    }

    /**
     * @param array $data
     * @param int $id
     * @return Patient|Builder|Model|object|null
     */
    public function updatePatient(array $data,int $id){
        $patient = Patient::whereId($id)->first();
        $patient->update($data["patient"]);

        if(isset($data["user"])){
            $user = User::whereId($patient->user_id)->first();

            if($user->email == $data["user"]["email"]){
                unset($data["user"]["email"]);
            }
            $user->update($data["user"]);
        }

        return $patient->refresh()->load("user");
    }
}
