<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Claim\GetClaimPreviewAction;
use App\Models\Claim;
use App\Models\ClaimBatch;
use App\Services\Claim\ClaimPreviewService;
use Illuminate\Http\Request;

final class ClaimPreviewController extends Controller
{
    public function show(Request $request, ClaimPreviewService $preview, GetClaimPreviewAction $resource)
    {
        $id = $request->id ?? null;
        $claim = Claim::with(['claimFormattable', 'insurancePolicies'])->find($id);
        $data = $resource->single($request->input(), $request->user());
        $preview->setConfig([
            'urlVerify' => 'www.nucc.org',
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

    public function showBatch(Request $request, ClaimPreviewService $preview, GetClaimPreviewAction $resource, int $id)
    {
        $batch = ClaimBatch::with([
            'claims' => function ($query) {
                $query->with('claimFormattable', 'insurancePolicies');
            },
        ])->find($id);
        $claims = $batch->claims;
        $total = count($claims);
        foreach ($claims as $key => $claim) {
            $data = $resource->single(['id' => $claim->id], $request->user());
            $preview->setConfig([
                'urlVerify' => 'www.nucc.org',
                'print' => (bool) ($request->print ?? false),
                'typeFormat' => $claim->format ?? null,
                'data' => $data->toArray($data),
            ]);
            $preview->setHeader();

            if (($total - 1) == $key) {
                return explode("\n\r\n", $preview->setBody('pdf.837P', true, [
                    'pdf' => $preview,
                ], 'E', true))[1];
            } else {
                $preview->setBody('pdf.837P', true, ['pdf' => $preview], 'E', false);
            }
        }
    }
}
