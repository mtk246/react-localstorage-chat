<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Enums\Claim\ClaimType;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

final class GetRulesListAction
{
    public function invoke(): Collection
    {
        $claimType = match (request()->input('type')) {
            'professional' => ClaimType::PROFESSIONAL,
            'institutional' => ClaimType::INSTITUTIONAL,
            default => null,
        };

        if ($claimType) {
            $items = config('claim.formats.'.$claimType->value);
            $name = $claimType->getName();

            return collect($items)->map(function ($item) use ($name) {
                return $this->getToGroups($item, $name);
            });

        // return $this->getRuleListFormated($items, $name);
        } else {
            return collect(config('claim.formats'))->mapWithKeys(function ($items, $key) {
                $name = ClaimType::tryFrom($key)->getName();
                // $formated = $this->getRuleListFormated($items, $name);
                $formated = collect($items)->map(function ($item) use ($name) {
                    return $this->getToGroups($item, $name);
                });

                return [$name => $formated];
            });
        }
    }

    private function getRuleListFormated(array $item, string $name): Collection
    {
        return collect($item)->map(function ($item) use ($name) {
            return collect($item)
                ->mapToGroups(function ($item, $key) {
                    $group = Str::onlyNumbers($key);
                    $item['code'] = $key;

                    return [$group => $item];
                })
                ->map(function ($item, $key) use ($name) {
                    return count($item) > 1
                        ? [
                            'code' => $key,
                            'type' => 'group',
                            'description' => __("claim.rules.{$name}.group.{$key}"),
                            'values' => $item->values(),
                        ]
                        : $item->first();
                })->values();
        });
    }

    private function getToGroups(array $array, string $name): array
    {
        $matriz = [];

        array_map(function ($indice, $valor) use (&$matriz, $name) {
            $niveles = explode('.', (string) $indice);

            $grupo = &$matriz;
            $ultimoNivel = end($niveles);

            foreach ($niveles as $nivel) {
                if (!isset($grupo[$nivel])) {
                    if ($nivel === $ultimoNivel) {
                        $grupo[$nivel] = $valor;
                    } else {
                        $grupo[$nivel] = [
                            'type' => 'group',
                            'description' => __("claim.rules.{$name}.group.{$nivel}"),
                            'values' => [],
                        ];
                    }
                }
                if ($nivel === $ultimoNivel) {
                    $grupo = &$grupo[$nivel];
                } else {
                    $grupo = &$grupo[$nivel]['values'];
                }
            }
        }, array_keys($array), $array);

        return $matriz;
    }
}
