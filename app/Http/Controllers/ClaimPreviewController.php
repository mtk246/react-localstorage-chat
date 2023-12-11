<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Claim\GetClaimPreviewAction;
use App\Actions\Claim\GetClaimTransmissionReportAction;
use App\Models\Claims\Claim;
use App\Models\Claims\ClaimBatch;
use App\Services\Claim\ClaimPreviewService;
use App\Services\ClearingHouse\ClearingHouseAPI;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

final class ClaimPreviewController extends Controller
{
    public function show(Request $request, ClaimPreviewService $preview, GetClaimPreviewAction $claimPreview)
    {
        $id = $request->id ?? null;
        $claim = Claim::query()->with(['insurancePolicies'])->find($id);
        $preview->setConfig([
            'urlVerify' => 'www.nucc.org',
            'print' => (bool) ($request->print ?? false),
            'typeFormat' => $claim->type->value ?? $request->format ?? null,
            'data' => $claimPreview->single($request->input(), $request->user()),
        ]);
        $preview->setHeader();

        /* @todo Consulta para poder devolver el pdf en como una cadena que sera renderizada por el frontEnd */
        return explode("\n\r\n", $preview->setBody('pdf.837P', true, [
            'pdf' => $preview,
        ]))[1];

        /* @todo Consulta para poder visualizar el pdf desde postman */
        // return $preview->setBody('pdf.837P', true, ['pdf' => $preview], 'I');
    }

    public function showBatch(Request $request, ClaimPreviewService $preview, GetClaimPreviewAction $claimPreview, int $id)
    {
        $claims = Claim::query()
            ->select('id', 'type')
            ->whereHas('claimBatchs', function ($query) use ($id) {
                $query->where('claim_batch_id', $id);
            })
            ->get();

        $total = count($claims);
        foreach ($claims as $key => $claim) {
            $preview->setConfig([
                'urlVerify' => 'www.nucc.org',
                'print' => (bool) ($request->print ?? false),
                'typeFormat' => $claim->type->value ?? null,
                'data' => $claimPreview->single(['id' => $claim->id], $request->user()),
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

    public function showBatchReport(Request $request, ClaimPreviewService $preview, GetClaimTransmissionReportAction $claimReport, int $id)
    {
        $batch = ClaimBatch::query()->find($id);
        $abbreviationCompany = $batch->company->abbreviations()
            ->where('billing_company_id', $batch->billing_company_id)
            ->first()
            ?->abbreviation ?? '';

        $preview->setConfig([
            'urlVerify' => 'www.nucc.org',
            'isTransmissionResponse' => true,
            'reportDate' => Carbon::createFromFormat('Y-m-d', $batch->shipping_date)->format('m/d/Y H:i:s A'),
        ]);

        $preview->setHeader(
            'Claims Transmission report',
            (empty($abbreviationCompany)
                ? $batch->company->name
                : Str::upper($abbreviationCompany) . ' - ' . $batch->company->name) . ' / N° Claims: ' . $batch->total_claims
        );

        $preview->setFooter($batch->last_modified['user'] ?? '');

        return explode(
            "\n\r\n",
            $preview->setBody(
                'pdf.batch_report',
                true,
                [
                    'pdf' => $preview,
                    'claimsByPlan' => $claimReport->invoke($batch),
                ],
                'E',
                true,
                true
            )
        )[1];
    }

    public function showResponses(Request $request)
    {
        $data = [];
        $api = new ClearingHouseAPI();

        $claimBatchs = ClaimBatch::query()
            ->when(!empty($request->shipping_date), function ($query) use ($request) {
                $query->where('shipping_date', '>=', $request->shipping_date);
            })
            ->get();

        foreach ($claimBatchs as $key => $claimBatch) {
            foreach ($claimBatch->claims ?? [] as $key => $claim) {
                $claimResponse = json_decode(
                    $claim->claimTransmissionResponses
                        ->where('claim_batch_id', $claimBatch->id)
                        ->first()?->response_details ?? ""
                )?->response;

                $user = $claim->audits?->first()?->user ??  null;
                $insurance = $claim->higherInsurancePlan();

                $data[] = [
                    'Batch code' => $claimBatch->code,
                    'Claim code' => $claim->code,
                    'Claim type' => Str::title($claim->type->getName()),
                    'Company name' => $claim->demographicInformation->company->name,
                    'Patient name' => $claim->demographicInformation->patient->profile->fullName(),
                    'PayerID' => $insurance?->payer_id,
                    'CPID' => $api->getDataByPayerID(
                        $insurance?->payer_id,
                        $insurance?->name,
                        $claim->type->value,
                        $claimBatch?->fake_transmission ?? false,
                        'cpid'
                    ),
                    'Insurance Plan' => $insurance?->name,
                    'User' => $user->profile->fullName(),

                    'status' => isset($claimResponse->status) && ('SUCCESS' === $claimResponse->status)
                        ? $claimResponse->status
                        : 'ERROR',
                    'response' => isset($claimResponse->status) && ('SUCCESS' !== $claimResponse->status)
                        ? $claimResponse?->errors ?? $claimResponse
                        : $claimResponse?->errors ?? '',
                ];
            }
        }

        return $data;
    }
}
