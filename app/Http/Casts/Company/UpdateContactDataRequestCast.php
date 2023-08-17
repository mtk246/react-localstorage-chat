<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Facades\Gate;

final class UpdateContactDataRequestCast extends CastsRequest
{
    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && $this->get('billing_company_id')
            ? (int) $this->get('billing_company_id')
            : $this->user->billingCompanies->first()?->id;
    }

    public function getContact(): ContactCast
    {
        return $this->cast('contact', ContactCast::class);
    }

    public function getAddress(): AddressCast
    {
        return $this->cast('address', AddressCast::class);
    }

    public function getPaymentAddres(): ?PaymentAddressCast
    {
        return $this->cast('payment_address', PaymentAddressCast::class);
    }
}
