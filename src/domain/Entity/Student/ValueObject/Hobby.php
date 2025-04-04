<?php

namespace domain\Entity\Student\ValueObject;

use InvalidArgumentException;

class Hobby
{
    private ?string $value;

    public function __construct(?string $value)
    {
        if ($value === null || trim($value) === '') {
            $this->value = null;
            return;
        }

        $trimmed = trim($value);
        $length = mb_strlen($trimmed);

        if ($length > 100) {
            throw new InvalidArgumentException('趣味は100文字以内で入力してください。');
        }

        $this->value = $trimmed;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value ?? '';
    }
}
