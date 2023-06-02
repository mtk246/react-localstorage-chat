<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

final class ArrayCountRule implements Rule
{
    public function __construct(
        private readonly int $count = 0,
        private readonly int $operator = '>=',
        private readonly string $attribute = 'attribute',
    )
    {
    }

    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return is_array($value) && $this->isCountValid($value);
    }

    public function message(): string
    {
        return "The {$this->attribute} must be an array with {$this->operator} {$this->count} items.";
    }

    private function isCountValid(array $value): bool
    {
        $count = count($value);

        $operations = [
            '='  => $count == $this->count,
            '>'  => $count > $this->count,
            '>=' => $count >= $this->count,
            '<'  => $count < $this->count,
            '<=' => $count <= $this->count,
            '<>' => $count <> $this->count,
        ];

        return array_key_exists($this->operator, $operations) && $operations[$this->operator];
    }
}
