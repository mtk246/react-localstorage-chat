<?php

declare(strict_types=1);

namespace App\Rules\Company;

use App\Models\ContractFee;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Gate;

final class CustomValidateExist implements Rule
{
    public function passes($attribute, $value)
    {
        $collection = collect(request()->all()['contract_fees']);
        $index = $collection->search(fn ($item) => isset($item['id']) ? $item['id'] === $value : null);

        $contract = ContractFee::when(
                Gate::allows('is-admin'),
                fn ($query)  => $query->where('billing_company_id', $collection[$index]['billing_company_id']),
            )->find($value);

        return $contract ?? false;
    }

    public function message(): string
    {
        return "This contract can't be updated because it does not exist for this billing company.";
    }
}
