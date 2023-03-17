<?php

declare(strict_types=1);

namespace App\Actions\BillingCompany;

use App\Models\BillingCompany;

// use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class GetBillingCompany
{
    public function filtered(array $request)
    {
        return BillingCompany::query()
            ->whereNotIn('id', $request['ids'])
            ->get(['id', 'name'])
            ->setHidden([
                'last_modified',
                'contact',
                'address',
                'contacts',
                'addresses',
            ]);
    }
}
