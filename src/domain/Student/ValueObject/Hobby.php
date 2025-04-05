<?php

namespace domain\Student\ValueObject;

use InvalidArgumentException;

class Hobby
{
    private ?string $value;
    private const MAX_LENGTH = 100;

    public function __construct(?string $value)
    {
        if ($value === null || trim($value) === '') {
            $this->value = null;
            return;
        }

        $trimmed = trim($value);
        $length = mb_strlen($trimmed);

        if ($length > self::MAX_LENGTH) {
            throw new InvalidArgumentException('趣味は' . self::MAX_LENGTH . '100文字以内で入力してください。');
        }

        $this->value = $trimmed;
    }

    public function __toString(): string
    {
        return $this->value ?? '';
    }
}
