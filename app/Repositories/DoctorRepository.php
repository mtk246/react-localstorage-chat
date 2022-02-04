<?php

namespace App\Repositories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DoctorRepository
{
    /**
     * @param array $data
     * @return Doctor|Model|null
     */
    public function createDoctor(array $data){
        $doc = Doctor::create($data);

        if(is_null($doc)) return null;

        return $doc->load("user");
    }

    /**
     * @param array $data
     * @param int $id
     * @return Doctor|Builder|Model|object|null
     */
    public function updateDoc(array $data,int $id){
        $doc = Doctor::whereId($id)->first();

        if(is_null($doc)) return null;

        $doc->update($data);

        return Doctor::whereId($id)->first();
    }

    /**
     * @return Doctor[]|Collection
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
