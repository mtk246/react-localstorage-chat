<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Claim\GetClaimPreviewAction;
use App\Models\Claim;
use App\Services\Claim\ClaimPreviewService;
use Illuminate\Http\Request;

final class ClaimPreviewController extends Controller
{
    public function show(Request $request, ClaimPreviewService $preview, GetClaimPreviewAction $resource)
    {
        $id = $request->id ?? null;
        $claim = Claim::with(['claimFormattable', 'insurancePolicies', 'claimFormattable'])->find($id);
        $data = $resource->single($request->input(), $request->user());
        $preview->setConfig([
            'urlVerify' => 'www.google.com.ve',
            'print' => $request->print ?? false,
            'typeFormat' => $claim->format ?? null,
            'data' => $data->toArray($request),
        ]);
        $preview->setHeader();

        /* @todo Consulta para poder devolver el pdf en como una cadena que sera renderizada por el frontEnd */
        return explode("\n\r\n", $preview->setBody('pdf.837P', true, [
            'pdf' => $preview,
        ]))[1];

        /* @todo Consulta para poder visualizar el pdf desde postman */
        /**return $preview->setBody('pdf.837P', true, ['pdf' => $preview], 'I');*/
    }
}
