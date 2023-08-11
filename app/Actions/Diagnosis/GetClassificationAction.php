<?php

namespace App\Actions\Diagnosis;

use App\Enums\Diagnoses\ICD10\GeneralType;
use App\Http\Resources\Enums\TypeResource;

final class GetClassificationAction {

    public function getClassifications($code)
    {
        $letterCode = strtoupper($code[0]);
        $codeType = intval(substr($code, 1, 2));

        $gtype = $this->findMatchClassifications($letterCode, $codeType);

        return $gtype;
    }

    private function findMatchClassifications($letterCode, $codeType)
    {
        $matchingType = collect(GeneralType::cases())->map(function($type) use ($letterCode, $codeType) {
            $typeRange = $type->getRange();

            if ($this->isCodeInRange($letterCode, $codeType, $typeRange)) {
                $matchingSType = collect($type->getChild()::cases())->first(function($sType) use ($letterCode, $codeType) {
                    $sTypeRange = $sType->getRange();

                    if ($this->isCodeInRange($letterCode, $codeType, $sTypeRange)) {
                        return $sType;
                    }
                });

                return [
                    'general' => new TypeResource($type),
                    'specific' => new TypeResource($matchingSType)
                ];
            }
        });

        return  $matchingType->whereNotNull()->first();
    }

    private function isCodeInRange($letterCode, $codeType, $typeRange)
    {
        $letterCodeMin = strtoupper($typeRange->min[0]);
        $codeTypeMin = intval(substr($typeRange->min, 1, 2));
        $letterCodeMax = strtoupper($typeRange->max[0]);
        $codeTypeMax = intval(substr($typeRange->max, 1, 2));

        return ($letterCode == $letterCodeMin || $letterCode == $letterCodeMax)
            && ($codeType >= $codeTypeMin && $codeType <= $codeTypeMax);
    }
}