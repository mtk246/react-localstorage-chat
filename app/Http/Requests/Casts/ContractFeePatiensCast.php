<?php

declare(strict_types=1);

namespace App\Http\Requests\Casts;

use App\Models\User;

final class ContractFeePatiensCast
{
    /** @param array<key, string|int|null> $items*/
    public function __construct(private array $items, private User $user)
    {
    }

    public function getId(): int
    {
        return $this->items['user_id'];
    }

    public function getStartDate(): ?string
    {
        return array_key_exists('start_date', $this->items)
            ? $this->items['start_date']
            : null;
    }

    public function getEndDate(): ?string
    {
        return array_key_exists('end_date', $this->items)
            ? $this->items['end_date']
            : null;
    }
}
