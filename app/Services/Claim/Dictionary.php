<?php

declare(strict_types=1);

namespace App\Services\Claim;

use App\Enums\Claim\RuleType;
use App\Models\Claims\Claim;
use App\Models\Claims\ClaimBatch;
use App\Models\Claims\Rules;
use App\Models\Company;
use App\Models\InsuranceCompany;
use Carbon\Carbon;
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
        protected readonly ?ClaimBatch $batch = null,
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
            RuleType::SINGLE_ARRAY->value => $this->getSingleArrayFormat($config->value),
            RuleType::MULTIPLE->value => $this->getMultipleFormat($config->value, $config->glue ?? ''),
            RuleType::MULTIPLE_ARRAY->value => $this->getMultipleArrayFormat($config->value, $config->glue ?? ''),
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

    protected function getMultipleArrayFormat(array $values, string $glue): array
    {
        return Collect($values)
            ->reduce(function (?Collection $carry, string $value) use ($glue) {
                $items = $this->getSingleFormat($value);
                $items = $items instanceof Collection ? $items : Collect([$items]);

                if (is_null($carry)) {
                    return $items;
                }

                return $carry
                    ->filter(fn (string $value) => !empty($value))
                    ->map(function ($item, $key) use ($items, $glue) {
                        return $item.$glue.$items[$key];
                    });
            })
            ->toArray();
    }

    protected function getMultipleFormat(array $values, string $glue): string
    {
        return Collect($values)
            ->map(fn (string $value) => (string) $this->getSingleFormat($value))
            ->filter(fn (string $value) => !empty($value))
            ->implode($glue);
    }

    protected function getSingleArrayFormat(string $value): array
    {
        return $this->getSingleFormat($value)
            ->toArray();
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
        list($key, $format, $rawFormat, $default) = Str::of($value)->explode('|')->pad(4, null)->toArray();

        $accesor = 'get'.Str::ucfirst(Str::camel($key)).'Attribute';

        $rawDate = method_exists($this, $accesor)
            ? $this->$accesor($key, $default)
            : $this->getClaimData($key, $default);

        if ($rawDate instanceof Carbon) {
            return $rawDate->format(str_replace('%', ' ', $format));
        }

        return $rawDate
            ? Carbon::createFromFormat($rawFormat ?? 'Y-m-d', $rawDate)->format(str_replace('%', ' ', $format))
            : '';
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
        if (!is_null($default)) {
            return $default;
        }

        return Collect(explode('.', $key))
            ->map(function (string $data) {
                list($key, $properties) = Str::of($data)->explode(':')->pad(2, null)->toArray();

                return (object) [
                    'key' => $key,
                    'properties' => $properties
                        ? explode(',', $properties)
                        : [],
                ];
            })
            ->reduce(function (mixed $carry, object $item) {
                if (isset($carry->{$item->key})) {
                    return $carry->{$item->key};
                }

                if (method_exists($carry, $item->key)) {
                    return $carry->{$item->key}(...$item->properties);
                }

                return '';
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
