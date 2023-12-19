<?php

declare(strict_types=1);

namespace App\Policies\Payments;

use App\Enums\Payments\BatchStateType;
use App\Models\Payments\Batch;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

final class BatchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Batch $batch): bool
    {
        return Gate::check('is-admin')
            || $user->billing_company_id === $batch->billing_company_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return Gate::check('is-admin');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Batch $batch)
    {
        return Gate::check('is-admin')
            || ($user->billing_company_id === $batch->billing_company_id && BatchStateType::COMPLETED->value !== $batch->status->value);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Batch $batch)
    {
        return Gate::check('is-admin')
            || ($user->billing_company_id === $batch->billing_company_id && BatchStateType::COMPLETED->value !== $batch->status->value);
    }
}
