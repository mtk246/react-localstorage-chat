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
    public function user(RecoveryUserRequestCast $request): ?string
    {
        return DB::transaction(function () use ($request) {
            $query = Profile::query()
                ->whereFirstName($request->getFirstName())
                ->whereLastName($request->getLastName())
                ->whereDateOfBirth($request->getBirthDate())
                ->when($request->getSsn(), function (Builder $query) use ($request) {
                    $ssn = $request->getSsn();
                    $ssnFormated = substr($ssn, 0, 1).'-'.substr($ssn, 1, strlen($ssn));

                    return $query->where('ssn', 'ilike', "%{$ssn}")
                        ->orWhere('ssn', 'ilike', "%{$ssnFormated}");
                });

            $profile = $query->with('user')->first(['id']);

            if (is_null($profile->user)) {
                return null;
            }

            ChangePassword::dispatch($profile->user);

            $emailFormated = explode('@', $profile->user->email);

            return middleRedactor($emailFormated[0], '*').'@'.middleRedactor($emailFormated[1], '*');
        });
    }
}
