<?php

namespace App\Http\Controllers;

use App\Models\Metadata;
use App\Models\User;

class MetadataController extends Controller
{
    /**
     * @return void
     */
    public static function saveLogAuditory(array $data, $user_id = null, $emailUser = null)
    {
        if (!is_null($user_id)) {
            $user = User::whereId($user_id)->first();
        } else {
            $user = User::whereEmail($emailUser)->first();
        }

        if ($user) {
            $data['user_id'] = $user->id;

            Metadata::create($data);
        }
    }
}
