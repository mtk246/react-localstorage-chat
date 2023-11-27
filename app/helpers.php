<?php

declare(strict_types=1);

function randomNumber($length): string
{
    $result = '';

    for ($i = 0; $i < $length; ++$i) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}

function in_array_any($needles, $haystack)
{
    return !empty(array_intersect($needles, $haystack));
}

function middleRedactor($string, $char)
{
    $substring = substr($string, 1, strlen($string));
    $total = strlen($substring);
    $tenth = (int) ceil($total / 10);

    // Make sure single character strings get redacted
    $length = ($total > $tenth) ? ($total - $tenth) : 1;

    return substr($string, 0, 1).str_pad(substr($substring, $length), $total, $char, STR_PAD_LEFT);
}

if (!function_exists('generateNewCode')) {
    function generateNewCode(
        ?string $prefix,
        int $code_length,
        ?string $suffix,
        string $model,
        string $field = 'code',
    ): string {
        $codeFormat = implode('-', array_filter([$prefix, '%', $suffix]));

        $codeCount = $model::select($field)
            ->where($field, 'like', $codeFormat)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->count() + 1;

        if (strlen((string) $codeCount) > $code_length) {
            return ['error' => 'The new code exceeds the allowed length'];
        }

        $codeCount = str_pad((string) $codeCount, $code_length, '0', STR_PAD_LEFT);

        return str_replace('%', $codeCount, $codeFormat);
    }
}

if (!function_exists('getPrefix')) {
    function getPrefix($name)
    {
        $prefix = '';
        $stringName = explode(' ', trim(str_replace([',', '.', '-'], '', strtoupper($name))));
        if (count($stringName) > 1) {
            $prefix = ((1 == strlen($stringName[0])) ? $stringName[0] : substr($stringName[0], 0, 2)).((1 == strlen($stringName[1])) ? $stringName[1] : substr($stringName[1], 0, 2));
        } else {
            $prefix = (strlen($stringName[0]) <= 4) ? $stringName[0] : substr($stringName[0], -4, 4);
        }

        return trim($prefix);
    }
}

if (!function_exists('getList')) {
    function getList($model, $fields = 'name', $filters = [], $except_id = null, $others = [], $pivotOthers = [])
    {
        $records = (is_object($model)) ? $model : $model::all();
        if ($filters) {
            if (isset($filters['whereRaw'])) {
                $search = $filters['whereRaw']['search'];
                $records = $model::whereRaw("LOWER($fields) LIKE (?)", [strtolower("%$search%")])->get();
            } elseif (isset($filters['not_exists'])) {
                /** Filtra la información a obtener mediante relaciones */
                $exists = $filters['not_exists'];
                if (isset($filters['orWhereHas'])) {
                    $relationship = $filters['orWhereHas']['relationship'];
                    $records = $model::has($exists, 0)->where($filters['where'])
                        ->orWhereHas($relationship, function ($q) use ($filters) {
                            $q->whereNotIn($filters['orWhereHas']['where'][0], $filters['orWhereHas']['where'][1]);
                        })->where($filters['where'])->get();
                } else {
                    $records = $model::has($exists, 0)->where($filters['where'])->get();
                }
            } elseif (isset($filters['exists'])) {
                /** Filtra la información a obtener mediante relaciones */
                $exists = $filters['exists'];
                if (isset($filters['whereHas'])) {
                    $relationship = $filters['whereHas']['relationship'];
                    $records = $model::whereHas($relationship, function ($q) use ($filters) {
                        $q->where($filters['whereHas']['where']);
                    })->where($filters['where'])->get();
                } else {
                    $records = $model::has($exists, 0)->where($filters['where'])->get();
                }
            } elseif (!isset($filters['relationship'])) {
                $records = $model::where($filters)->get();
            } else {
                /** Filtra la información a obtener mediante relaciones */
                $relationship = $filters['relationship'];
                $records = $model::whereHas($relationship, function ($q) use ($filters) {
                    $q->where($filters['where']);
                })->get();
            }
        }
        $options = [];

        foreach ($records as $rec) {
            if (is_array($fields)) {
                $text = '';
                foreach ($fields as $field) {
                    $text .= ('-' !== $field && ' ' !== $field)
                        ? $rec->$field
                        : ((' ' === $field) ? $field : " {$field} ");
                }
            } else {
                $text = $rec->$fields;
            }

            if (is_null($except_id) || ((!is_array($except_id)) && $except_id !== $rec->id) || (is_array($except_id) && (!in_array($rec->id, $except_id)))) {
                $fieldPush = ['id' => $rec->id, 'name' => $text];
                foreach ($others as $other) {
                    $fieldPush[$other] = $rec->$other;
                }
                foreach ($pivotOthers as $name => $pivotOther) {
                    if (is_array($pivotOther)) {
                        $relationship = $pivotOther['relationship'];
                        $rec->load($relationship);
                        $object = $rec->$relationship()->where($pivotOther['where'])->first();
                        $fieldPush[$name] = $object->pivot[$name] ?? $object->$name ?? '';
                    } else {
                        $object = $rec->$relationship()->where($filters['where'])->first();
                        if (isset($object)) {
                            $fieldPush[$pivotOther] = $object->pivot[$pivotOther];
                        }
                    }
                }
                array_push($options, $fieldPush);
            }
        }

        return $options;
    }
}

if (!function_exists('toModel')) {
    function toModel($entity, $namespace = '\App\Models')
    {
        return $namespace.'\\'.implode('', array_map('ucfirst', explode('-', $entity)));
    }
}

if (!function_exists('upperCaseWords')) {
    function upperCaseWords($string): string
    {
        return ucwords(strtolower($string ?? ''));
    }
}

if (!function_exists('has_foreign_key')) {
    function has_foreign_key($table, $foreignKey)
    {
        /** @var object Objeto con información detallada de las propiedades de la tabla */
        $detailTable = Schema::getConnection()->getDoctrineSchemaManager()->listTableDetails($table);

        return $detailTable->hasForeignKey($foreignKey);
    }
}

if (!function_exists('filter_array_empty')) {
    function filter_array_empty($array): array
    {
        return array_filter($array, function ($item) {
            return count(array_filter($item, function ($value) {
                return !empty($value);
            })) > 0;
        });
    }
}

if (!function_exists('array_empty')) {
    function array_empty($array): bool
    {
        return empty(array_filter($array, function ($value) {
            return !empty($value);
        }));
    }
}

if (!function_exists('array_filter_recursive')) {
    function array_filter_recursive(array $array)
    {
        foreach ($array as &$value) {
            if (is_array($value)) {
                $value = array_filter_recursive($value);
            }
        }

        return array_filter($array, function ($value) {
            return !is_null($value) && '' !== $value && ([] !== $value || (is_array($value) && !array_empty($value)));
        });
    }
}
