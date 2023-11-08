<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Facades\Gate;

final class UpdateNotesRequestCast extends CastsRequest
{
    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && $this->has('billing_company_id')
            ? $this->getInt('billing_company_id')
            : $this->user->billing_company_id;
    }

    public function getPublicNote(): ?string
    {
        return $this->get('public_note');
    }

    public function getPrivateNote(): ?string
    {
        return $this->get('private_note');
    }
}
