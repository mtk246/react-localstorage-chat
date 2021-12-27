<?php

namespace App\Repositories;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

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

}
