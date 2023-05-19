<?php

declare(strict_types=1);

namespace App\Enums\Traits;

use Illuminate\Support\Str;

trait HasAttributes
{
    public function getAttribute(string $Attribute): string|int|bool|null
    {
        $classAttributes = (new \ReflectionClassConstant(self::class, $this->name))->getAttributes();

        $atribute = array_filter($classAttributes, function ($classAttribute) use ($Attribute) {
            return $classAttribute->getName() === $Attribute;
        });

        return 0 < count($atribute)
            ? $atribute[array_key_first($atribute)]?->getArguments()[0]
            : null;
    }

    public function getAttributeOrFail(string $Attribute): string|int|bool
    {
        return $this->getAttribute($Attribute) ?? throw new \Exception($this->getErrorMessage($Attribute));
    }

    protected function getErrorMessage(string $Attribute): string
    {
        return Str::replaceArray('?', [
            Str::afterLast($Attribute, '\\'),
            Str::afterLast(self::class, '\\'),
            $this->name,
        ], $this->errorMessage());
    }

    protected function errorMessage(): string
    {
        return 'Attribute "?" not found on enum "?" on case "?"';
    }
}
