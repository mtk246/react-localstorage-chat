<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tableau;

use App\Actions\Tableau\JWTGenerator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tableau\WorkbookRequest;
use Illuminate\Http\JsonResponse;

final class AuthController extends Controller
{
    public function getEmbedToken(WorkbookRequest $request, JWTGenerator $Tableau): JsonResponse
    {
        return response()->json($Tableau->embed());
    }
}
