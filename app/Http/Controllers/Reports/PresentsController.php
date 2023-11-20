<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Reports\Present;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PresentsController extends Controller
{
    public function index() {
        $presents = Present::all();
        return response()->json($presents);
    }
}
