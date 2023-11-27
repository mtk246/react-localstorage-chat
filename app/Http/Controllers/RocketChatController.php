<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\RocketChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

final class RocketChatController extends Controller
{
    public function getToken(Request $request, RocketChatService $service): JsonResponse
    {
        $email = $request->user()->email;

        if (!$service->userExist($email)) {
            Log::info(sprintf('User %s dont have a roket chat user', $email));

            abort(404, 'User dont have a roket chat user');
        }

        $token = $service->getResumeToken(
            $service->getUserList(['emails.address' => $email])[0]['_id']
        );

        return response()->json(['token' => $token]);
    }
}
