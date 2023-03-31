<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Events\User\ChangePassword;
use App\Http\Casts\User\RecoveryUserRequestCast;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

final class Recovery
{
    /** @return array<key, string> */
    public function user(RecoveryUserRequestCast $request): ?array
    {
        /* @return array<key, string> */
        return DB::transaction(function () use ($request): array {
            $profile = Profile::query()
                ->whereDateOfBirth($request->getBirthDate())
                ->where('first_name', 'ilike', "%{$request->getFirstName()}%")
                ->where('last_name', 'ilike', "%{$request->getLastName()}%")
                ->when($request->getSsn(), function (Builder $query) use ($request) {
                    $ssn = $request->getSsn();
                    $ssnFormated = substr($ssn, 0, 1).'-'.substr($ssn, 1, strlen($ssn));

                    return $query->where('ssn', 'ilike', "%{$ssn}")
                        ->orWhere('ssn', 'ilike', "%{$ssnFormated}");
                })
                ->with('user')
                ->first(['id']);

            if (is_null($profile?->user)) {
                return null;
            }

            ChangePassword::dispatch($profile->user);

            $emailFormated = explode('@', $profile->user->email);

            return ['email' => middleRedactor($emailFormated[0], '*').'@'.middleRedactor($emailFormated[1], '*')];
        });
    }
}
