<?php

function randomNumber($length): string
{
    $result = '';

    for($i = 0; $i < $length; $i++) {
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
    $tenth = ceil($total / 10);

    // Make sure single character strings get redacted
    $length = ($total > $tenth) ? ($total - $tenth) : 1;

    return substr($string, 0, 1) . str_pad(substr($substring, $length), $total, $char, STR_PAD_LEFT);
}

if (!function_exists('generateNewCode')) {
    function generateNewCode($prefix, $code_length, $year, $model, $field)
    {
        $newCode = 1;

        $targetModel = $model::select($field)->where($field, 'like', "{$prefix}-%-{$year}")
            ->orderBy('created_at', 'desc')->orderBy('id', 'desc')->first();
        
        $newCode += ($targetModel) ? (int)explode('-', $targetModel->$field)[1] : 0;

        if (strlen((string)$newCode) > $code_length) {
            return ["error" => "The new code exceeds the allowed length"];
        }
        $newCode = str_pad($newCode, $code_length, "0", STR_PAD_LEFT);
        
        return "{$prefix}-{$newCode}-{$year}";
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
            } else if (!isset($filters['relationship'])) {
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
                    $text .= ($field !== "-" && $field !== " ")
                        ? $rec->$field
                        : (($field === " ") ? $field : " {$field} ");
                }
            } else {
                $text = $rec->$fields;
            }

            if (is_null($except_id) || $except_id !== $rec->id) {
                $fieldPush = ['id' => $rec->id, 'name' => $text];
                foreach ($others as $other) {
                    $fieldPush[$other] = $rec->$other;
                }
                foreach ($pivotOthers as $pivotOther) {
                    $object = $rec->$relationship()->where($filters['where'])->first();
                    if (isset($object)) {
                        $fieldPush[$pivotOther] = $object->pivot[$pivotOther];
                    }
                }
                array_push($options, $fieldPush);
            }
        }
        return $options;
    }
}

if (!function_exists('toModel')) {
    function toModel($entity, $namespace = '\App\Models') {
        return $namespace . '\\' . implode('', array_map('ucfirst', explode('-', $entity)));
    }
}

if (!function_exists('upperCaseWords')) {
    function upperCaseWords($string) {
        return ucwords(strtolower($string));
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
