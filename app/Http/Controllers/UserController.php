<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function createUser(UserCreateRequest $request): \Illuminate\Http\JsonResponse
    {
        /** @var  $user User*/
        $user = $this->userRepository->create($request);

        return response()->json($user->load("roles"),201);
    }
}
