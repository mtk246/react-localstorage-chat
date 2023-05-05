<?php

namespace App\Http\Controllers\Tableau;

use App\Actions\Tableau\JWTGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class AuthController extends Controller
{
    public function getEmbedToken(JWTGenerator $Tableau): JsonResponse
    {
        return response()->json($Tableau->embed());
    }
}
