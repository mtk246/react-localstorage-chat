<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Tableau\JWTGenerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class TableauController extends Controller
{
    public function getEmbedToken(Request $request, JWTGenerator $Tableau): JsonResponse
    {
        return response()->json($Tableau->embed());
    }
}
