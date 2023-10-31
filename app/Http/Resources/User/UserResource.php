<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

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
            'updated_at' => $this->resource->created_at,
            'created_at' => $this->resource->updated_at,
            'profile_id' => $this->resource->profile_id,
            'profile' => new ProfileResource($this->resource->profile),
            'language' => $this->resource->language,
            'last_modified' => $this->resource->last_modified,
            'type' => $this->resource->type->value,
            'roles' => $this->resource->roles
                ? RoleResource::collection($this->resource->roles)
                : null,
            'billing_company_id' => $this->resource->billing_company_id,
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

    private function getSocialMedias(int $billingCompanyId): ?Collection
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
            ->profile
            ->addresses
            ->first(
                fn ($address) => $address->billing_company_id === $billingCompanyId,
            ) ?? null;
    }

    private function getContact(int $billingCompanyId)
    {
        return $this->resource
            ->profile
            ->contacts
            ->filter(
                fn ($contact) => $contact->billing_company_id === $billingCompanyId,
            )->first() ?? null;
    }
}
