<?php

declare(strict_types=1);

namespace App\Services\Claim;

use App\Enums\Claim\RuleType;
use App\Models\Claims\Claim;
use App\Models\Claims\Rules;
use App\Models\Company;
use App\Models\InsuranceCompany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class Dictionary implements DictionaryInterface
{
    protected string $format;
    protected array $config;

    public function __construct(
        protected readonly Claim $claim,
        protected readonly ?Company $company,
        protected readonly ?InsuranceCompany $insuranceCompany,
    ) {
        $this->setConfigFor();
    }

    public function translate(string $key): array|string|bool
    {
        if (!array_key_exists($key, $this->config)) {
            throw new \InvalidArgumentException('Invalid format key');
        }

        $config = (object) $this->config[$key];

        return match ($config->type) {
            RuleType::DATE->value => $this->getDateFormat($config->value),
            RuleType::BOOLEAN->value => $this->getBooleanFormat($config->value),
            RuleType::SINGLE->value => $this->getSingleFormat($config->value),
            RuleType::MULTIPLE->value => $this->getMultipleFormat($config->value, $config->glue ?? ''),
            RuleType::NONE->value => '',
            default => throw new \InvalidArgumentException('Invalid format type'),
        };
    }

    public function toArray(): array
    {
        return array_combine(
            array_keys($this->config),
            array_map(function ($key) {
                return $this->translate((string) $key);
            }, array_keys($this->config))
        );
    }

    protected function getMultipleFormat(array $values, string $glue): string
    {
        return Collect($values)
            ->map(fn (string $value) => (string) $this->getSingleFormat($value))
            ->implode($glue);
    }

    protected function getSingleFormat(string $value): string|Collection
    {
        list($key, $default) = Str::of($value)->explode('|')->pad(2, null)->toArray();

        list($accesorKey, $property) = Str::of($key)->explode(':')->pad(2, null)->toArray();
        $accesor = 'get'.Str::ucfirst(Str::camel($accesorKey)).'Attribute';

        return method_exists($this, $accesor)
            ? $this->$accesor($property, $default)
            : $this->getClaimData($key, $default);
    }

    protected function getDateFormat(string $value): string
    {
        list($key, $format, $default) = Str::of($value)->explode('|')->pad(3, null)->toArray();

        $accesor = 'get'.Str::ucfirst(Str::camel($key)).'Attribute';

        return method_exists($this, $accesor)
            ? $this->$accesor($key, $format, $default)
            : $this->getClaimData($key, $default)->format($format);
    }

    protected function getBooleanFormat(string $value): bool
    {
        list($key, $default) = Str::of($value)->explode('|')->pad(2, null)->toArray();

        list($accesorKey, $property) = Str::of($key)->explode(':')->pad(2, null)->toArray();
        $accesor = 'get'.Str::ucfirst(Str::camel($accesorKey)).'Attribute';

        return method_exists($this, $accesor)
            ? (bool) $this->$accesor($property, $default)
            : (bool) $this->getClaimData($key, $default);
    }

    protected function getClaimData(string $key, ?string $default = null): mixed
    {
        if ($default) {
            return $default;
        }

        return Collect(explode('.', $key))
            ->map(function (string $data) {
                list($key, $properties) = Str::of($data)->explode(':')->pad(2, null)->toArray();

                return (object) [
                    'key' => Str::camel($key),
                    'properties' => $properties
                        ? explode(',', $properties)
                        : [],
                ];
            })
            ->reduce(function (?Model $carry, object $item) {
                return property_exists($carry, $item->key)
                    ? $carry->{$item->key}
                    : $carry->{$item->key}(...$item->properties);
            }, $this->claim);
    }

    protected function setConfigFor(?InsuranceCompany $insuranceCompany = null): void
    {
        $rules = config("claim.formats.{$this->claim->type->value}.{$this->format}");

        $customRules = Rules::query()
            ->where('insurance_company_id', $insuranceCompany?->id ?? $this->insuranceCompany->id)
            ->where('billing_company_id', $this->claim->billing_company_id)
            ->where('format', $this->claim->format)
            ->first()
            ?->rules;

        if ($customRules) {
            $rules = array_replace_recursive(
                $rules,
                $customRules[$this->format] ?? [],
            );
        }

        $this->config = $rules;
    }
}
