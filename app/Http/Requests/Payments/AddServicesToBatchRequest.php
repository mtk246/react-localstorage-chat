<?php

declare(strict_types=1);

namespace App\Http\Requests\Payments;

use App\Enums\Payments\RefileType;
use App\Http\Casts\Payments\AddServicesToBachWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use App\Models\Payments\Batch;
use Cknow\Money\Rules\Money;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

final class AddServicesToBatchRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = AddServicesToBachWrapper::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        /** @var Batch $batch */
        $batch = $this->route()->parameter('batch');
        $currency = $batch->currency;

        return [
            'payments' => 'required|array',
            'payments.*.id' => ['required', 'integer', Rule::exists('payments', 'id')->where(
                'payment_batch_id',
                $batch->id,
            )],

            'payments.*.claims' => 'nullable|array',
            'payments.*.claims.*' => ['required', 'integer', Rule::exists('claims', 'id')],

            'payments.*.services' => 'required|array',
            'payments.*.services.*.service_id' => 'required|integer|exists:services,id',
            'payments.*.services.*.payment' => ['required', 'string', new Money($currency)],
            'payments.*.services.*.exp_adj' => ['required', 'string', new Money($currency)],
            'payments.*.services.*.remain' => ['required', 'string', new Money($currency)],
            'payments.*.services.*.ins_amount' => ['required', 'string', new Money($currency)],
            'payments.*.services.*.claim_id' => 'nullable|string',
            'payments.*.services.*.resp_insurance' => ['nullable', 'string'],
            'payments.*.services.*.pt_resp' => ['required', 'string', new Money($currency)],
            'payments.*.services.*.reason' => ['nullable', 'string'],
            'payments.*.services.*.denial_reason' => ['nullable', 'string'],
            'payments.*.services.*.note' => ['nullable', 'string'],

            'payments.*.services.*.adjust' => 'required|array',
            'payments.*.services.*.adjust.*.amount' => ['nullable', 'string', new Money($currency)],
            'payments.*.services.*.adjust.*.adj_reason' => ['nullable', 'string'],

            'payments.*.services.*.refile' => 'nullable|array',
            'payments.*.services.*.refile.type' => ['nullable', 'string', new Enum(RefileType::class)],
            'payments.*.services.*.refile.policy_id' => [
                Rule::requiredIf(
                    fn () => RefileType::SECONDARY->value === $this->input('payments.*.services.*.refile.type')
                        || RefileType::CORRECTED->value === $this->input('payments.*.services.*.refile.type'),
                ),
                'nullable',
                'integer',
                'exists:claim_insurance_policy,id',
            ],
            'payments.*.services.*.refile.date' => [
                'required_if:payments.*.services.*.refile.type,'.RefileType::SECONDARY->value,
                'nullable',
                'date',
            ],

            'payments.*.services.*.refile.claim' => [
                'required_if:payments.*.services.*.refile.type,'.RefileType::CORRECTED->value,
                'nullable',
                'integer',
                'exists:claims,id',
            ],
            'payments.*.services.*.refile.reason' => [
                Rule::requiredIf(
                    fn () => RefileType::OTHER->value === $this->input('payments.*.services.*.refile.type')
                        || RefileType::CORRECTED->value === $this->input('payments.*.services.*.refile.type'),
                ),
                'nullable',
                'string',
            ],

            'payments.*.services.*.refile.note' => 'nullable|string',
        ];
    }
}
