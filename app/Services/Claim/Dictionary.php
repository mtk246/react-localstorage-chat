<?php

declare(strict_types=1);

namespace App\Services\Claim;

use App\Enums\Claim\RuleType;
use App\Models\Claims\Claim;
use App\Models\Claims\ClaimBatch;
use App\Models\Claims\Rules;
use App\Models\Company;
use App\Models\InsurancePlan;
use App\Models\InsurancePolicy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class Dictionary implements DictionaryInterface
{
    protected string $format;
    protected array $config;

    public function __construct(
        protected readonly Claim $claim,
        protected readonly ?Company $company,
        protected readonly ?InsurancePlan $insurancePlan,
        protected readonly ?ClaimBatch $batch = null,
        protected readonly ?string $rule = null,
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
            RuleType::DATE->value => $this->getDateFormat((object) $config->value),
            RuleType::BOOLEAN->value => $this->getBooleanFormat((object) $config->value),
            RuleType::SINGLE->value => $this->getSingleFormat((object) $config->value),
            RuleType::SINGLE_ARRAY->value => $this->getSingleArrayFormat((object) $config->value),
            RuleType::MULTIPLE->value => $this->getMultipleFormat($config->value, $config->glue ?? '', $key),
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
            ->reduce(function (?Collection $carry, array $value) use ($glue) {
                $items = $this->getSingleFormat((object) $value);
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

    protected function getMultipleFormat(array $values, string $glue, string $key): string|array
    {
        return Collect($values)
            ->map(fn ($value) => (string) $this->getSingleFormat((object) $value))
            ->filter(fn (string $value) => !empty($value))
            ->implode($glue);
    }

    protected function getSingleArrayFormat(object $value): array
    {
        return $this->getSingleFormat($value)
            ->toArray();
    }

    protected function getSingleFormat(object $value): string|bool|array|Collection
    {
        list($key, $default) = Str::of($value->id)->explode('|')->pad(2, null)->toArray();

        list($accesorKey, $property) = Str::of($key)->explode(':')->pad(2, null)->toArray();
        $accesor = 'get'.Str::ucfirst(Str::camel($accesorKey)).'Attribute';

        return method_exists($this, $accesor)
            ? $this->$accesor($property, $default)
            : $this->getClaimData($key, $default);
    }

    protected function getDateFormat(object $value): string
    {
        list($key, $format, $rawFormat, $default) = Str::of($value->id)->explode('|')->pad(4, null)->toArray();

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

    protected function getBooleanFormat(object $value): bool
    {
        list($key, $default) = Str::of($value->id)->explode('|')->pad(2, null)->toArray();

        list($accesorKey, $property) = Str::of($key)->explode(':')->pad(2, null)->toArray();
        $accesor = 'get'.Str::ucfirst(Str::camel($accesorKey)).'Attribute';

        return method_exists($this, $accesor)
            ? (bool) $this->$accesor($property, $default)
            : (bool) $this->getClaimData($key, $default);
    }

    protected function getClaimData(string $key, string $default = null): mixed
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

    protected function setConfigFor(InsurancePlan $insurancePlan = null): void
    {
        $rules = config("claim.formats.{$this->claim->type->value}.{$this->format}");

        $customRules = Rules::query()
            ->where('format', $this->claim->format)
            ->where('billing_company_id', $this->claim->billing_company_id)
            ->when(
                $this->rule,
                fn (Builder $query) => $query->where('id', $this->rule),
                fn (Builder $query) => $query
                    ->orWhereHas('company', fn (Builder $query) => $query->where('company.id', $this->company?->id ?? 0))
                    ->orWhereHas('insuranceCompany', fn (Builder $query) => $query->where('insurance_company.id', $insurancePlan?->insurance_company_id ?? $this->insurancePlan?->insurance_company_id))
                    ->orWhereHas('insurancePlans', fn (Builder $query) => $query->where('insurance_plans.id', $insurancePlan?->id ?? $this->insurancePlan?->id))
                    ->orWhereHas('typesOfResponsibilities', fn (Builder $query) => $query->whereIn('code', $this->insurancePlan
                        ?->insurancePolicies
                        ->where('billing_company_id', $this->claim->billing_company_id)
                        ->map(fn (InsurancePolicy $policy) => $policy
                            ->typeResponsibility
                            ?->code
                        )
                        ->unique()
                        ->filter() ?? []
                    ))
                    ->orDoesntHave('typesOfResponsibilities')
            )
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
