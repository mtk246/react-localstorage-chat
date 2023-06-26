<?php

declare(strict_types=1);

namespace App\Services\Claim;

use App\Enums\Claim\RuleType;
use App\Models\Claims\Claim;
use App\Models\Company;
use App\Models\InsuranceCompany;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class Dictionary implements DictionaryInterface
{
    protected string $format;

    public function __construct(
        protected readonly Claim $claim,
        protected readonly Company $company,
        protected readonly InsuranceCompany $insuranceCompany,
    ) {
    }

    public function translate(string $key): array|string
    {
        $config = config("claim.formats.{$this->claim->type->value}.{$this->format}.{$key}");

        if (!$config) {
            throw new \InvalidArgumentException('Invalid format key');
        }

        return match ($config->type) {
            RuleType::DATE->value => $this->getDateFormat($config->value),
            RuleType::BOOLEAN->value => $this->getBooleanFormat($config->value),
            RuleType::SINGLE->value => $this->getSingleFormat($config->value),
            RuleType::MULTIPLE->value => $this->getMultipleFormat($config->value),
            default => throw new \InvalidArgumentException('Invalid format type'),
        };
    }

    protected function getMultipleFormat(array $values): string
    {
        $result = '';

        foreach ($values as $value) {
            $result .= (string) $this->getSingleFormat($value);
        }

        return $result;
    }

    protected function getSingleFormat(string $value): string|Collection
    {
        list($model, $key) = explode(':', $value);

        $model = Str::camel($model);

        if (!method_exists($this->claim, $model)) {
            throw new \InvalidArgumentException('Invalid model getter');
        }

        $accesor = 'get'.Str::ucfirst($model).'Attribute';

        return method_exists($this, $accesor)
            ? $this->$accesor($key)
            : $this->claim->{$model}()->{$key};
    }

    protected function getDateFormat(string $value): string
    {
        list($model, $key, $format) = explode(':', $value);

        if (!method_exists($this->claim, $model)) {
            throw new \InvalidArgumentException('Invalid model getter');
        }

        $accesor = 'get'.Str::ucfirst($model).'Attribute';

        return method_exists($this, $accesor)
            ? $this->$accesor($key, $format)
            : $this->claim->$model->$key
                ->format($format);
    }

    protected function getBooleanFormat(string $value): bool
    {
        list($model, $key, $check) = explode(':', $value);

        if (!method_exists($this->claim, $model)) {
            throw new \InvalidArgumentException('Invalid model getter');
        }

        if ('null' == $check) {
            $check = $this->claim->$model->$key;
        }

        $accesor = 'get'.Str::ucfirst($model).'Attribute';

        return method_exists($this, $accesor)
            ? (bool) $this->$accesor($key, $check)
            : (bool) $check;
    }
}
