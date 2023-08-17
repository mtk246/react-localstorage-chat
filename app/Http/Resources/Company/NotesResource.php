<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Casts\Company\UpdateNotesRequestCast;
use App\Http\Resources\RequestWrapedResource;

final class NotesResource extends RequestWrapedResource
{
    /**
     * @param UpdateNotesRequestCast $request
     *
     * @return array<key, string>
     */
    public function toArray($request): array
    {
        return [
            'public_note' => $this->publicNote()->first(['note'])->note,
            'private_note' => $this->privateNotes()
                ->where('billing_company_id', $request->getBillingCompanyId())
                ->first('note')
                ->note,
        ];
    }
}
