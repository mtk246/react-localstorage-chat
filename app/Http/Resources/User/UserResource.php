<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

/**  @property User $resource */
final class UserResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'usercode' => $this->resource->usercode,
            'email' => $this->resource->email,
            'status' => $this->resource->status,
            'last_login' => $this->resource->last_login,
            'last_activity' => $this->resource->last_activity,
            'profile_id' => $this->resource->profile_id,
            'profile' => new ProfileResource($this->resource->profile),
            'language' => $this->resource->language,
            'roles' => RoleResource::collection($this->resource->roles),
            'billing_companies' => $this->resource->billingCompanies
                ->map(function ($model) {
                    $model->private_user = [
                        'socialMedias' => $this->getSocialMedias($model->id),
                        'address' => $this->getAddress($model->id),
                        'contact' => $this->getContact($model->id),
                    ];

                    return $model;
                }),
        ];
    }

    /**
     * Customize the pagination information for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param array $paginated
     * @param array $default
     *
     * @return array
     */
    public function paginationInformation($request, $paginated, $default)
    {
        return [
            'data' => $default['data'],
            'numberOfPages' => $default['links']['last'],
            'count' => $default['meta']['last_page'],
        ];
    }

    private function getSocialMedias(int $billingCompanyId): Collection
    {
        return $this->resource
            ->profile
            ->socialMedias
            ->filter(
                fn ($socialMedia) => $socialMedia->billing_company_id === $billingCompanyId,
            );
    }

    private function getAddress(int $billingCompanyId)
    {
        return $this->resource
            ->addresses
            ->first(
                fn ($address) => $address->billing_company_id === $billingCompanyId,
            ) ?? null;
    }

    private function getContact(int $billingCompanyId)
    {
        return $this->resource
            ->contacts
            ->filter(
                fn ($contact) => $contact->billing_company_id === $billingCompanyId,
            )[0] ?? null;
    }
}
