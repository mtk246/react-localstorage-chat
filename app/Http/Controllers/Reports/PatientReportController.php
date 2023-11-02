<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PatientReportController extends Controller
{
    public function __construct()
    {
        
    }

    public function detailedPatientSuperUser()
    {
        try {
            $rs = '';
            return $rs ? response()->json($rs) : response()->json(__('Error updating image billing company'), 400);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
