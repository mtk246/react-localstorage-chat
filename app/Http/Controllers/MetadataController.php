<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Metadata;

class MetadataController extends Controller
{
    /**
     * @param array $data
     * @param $user_id
     * @param $emailUser
     * @return void
     */
    public static function saveLogAuditory(array $data,$user_id=null,$emailUser=null){

        if(!is_null($user_id)) $user = User::whereId($user_id)->first();
        else $user = User::whereEmail($emailUser)->first();

        $data['user_id'] = $user->id;

        Metadata::create($data);
    }
}
