<?php

declare(strict_types=1);

namespace App\Services\Claim;

use App\Enums\Claim\RuleType;
use App\Models\Claims\Claim;

abstract class Dictionary implements DictionaryInterface
{
    protected string $format;

    public function __construct(protected readonly Claim $claim)
    {
    }

    public function translate(string $key): array|string
    {
        $config = config("claim.formats.{$this->claim->type->value}.{$this->format}.{$key}");

        return match ($config->type) {
            RuleType::DATE->value => $this->getDateFormat(),
            RuleType::BOOLEAN->value => $this->getBooleanFormat(),
            RuleType::SINGLE->value => $this->getSingleFormat(),
            RuleType::MULTIPLE->value => $this->getMultipleFormat(),
            default => throw new \InvalidArgumentException('Invalid format type'),
        };
    }

    protected function getMultipleFormat(): string|array
    {
        return '';
    }

    protected function getSingleFormat(): string|array
    {
        return '';
    }

    protected function getDateFormat(): string
    {
        return '';
    }

    protected function getBooleanFormat(): string
    {
        return '';
    }
}
