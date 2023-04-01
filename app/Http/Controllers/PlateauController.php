<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Plateau\JWTGenerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PlateauController extends Controller
{
    public function getEmbedToken(Request $request, JWTGenerator $plateau): JsonResponse
    {
        return response()->json($plateau->embed());
    }
}
