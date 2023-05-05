<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    public function getSheet($name = ''): JsonResponse
    {
        $value = "<script type='module' src='https://prod-useast-a.online.tableau.com/javascripts/api/tableau.embedding.3.latest.min.js'></script><tableau-viz id='tableau-viz' src='https://prod-useast-a.online.tableau.com/t/begento/views/ClaimsReportsPDFGenerator/Sheet12_1' width='1517' height='662' hide-tabs toolbar='bottom' ></tableau-viz>";

        return response()->json($value, 200);
    }
}
