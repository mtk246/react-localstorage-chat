<?php

declare(strict_types=1);

namespace App\Facades;

final class Pagination
{
    private const SORT_BY = 'id';
    private const SORT_DESC = false;
    private const ITEMS_PER_PAGE = 10;

    public static function sortBy(string $default = self::SORT_BY): string
    {
        return request()->query('sortBy') ?? $default;
    }

    public static function sortDesc(bool $default = self::SORT_DESC): string
    {
        return request()->query('sortDesc') ?? $default
            ? 'desc'
            : 'asc';
    }

    public static function itemsPerPage(int $default = self::ITEMS_PER_PAGE): int
    {
        return (int) (request()->query('itemsPerPage') ?? $default);
    }
}
