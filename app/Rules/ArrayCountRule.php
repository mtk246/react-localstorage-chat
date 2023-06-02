<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

final class ArrayCountRule implements Rule
{
    private string $attribute = '';

    public function __construct(
        private readonly int $count = 0,
        private readonly int $operator = '>=',
    ) {
        if (is_null($this->getOperatorName())) {
            throw new \Exception('Invalid operator');
        }
    }

    /**
     * @param string $attribute
     * @param mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->attribute = $attribute;

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
            '=' => $count == $this->count,
            '>' => $count > $this->count,
            '>=' => $count >= $this->count,
            '<' => $count < $this->count,
            '<=' => $count <= $this->count,
            '<>' => $count != $this->count,
        ];

        return array_key_exists($this->operator, $operations) && $operations[$this->operator];
    }

    private function getOperatorName(): ?string
    {
        $operators = [
            '=' => 'equal to',
            '>' => 'greater than',
            '>=' => 'greater than or equal to',
            '<' => 'less than',
            '<=' => 'less than or equal to',
            '<>' => 'not equal to',
        ];

        return array_key_exists($this->operator, $operators)
            ? $operators[$this->operator]
            : null;
    }
}
