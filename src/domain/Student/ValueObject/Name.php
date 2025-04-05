<?php

namespace domain\Student\ValueObject;

use InvalidArgumentException;

class Name
{
    private string $value;

    public function __construct(string $value)
    {
        $trimmed = trim($value);
        $length = mb_strlen($trimmed);
    
        if ($length < 2) {
            throw new InvalidArgumentException('氏名は2文字以上である必要があります。');
        }
    
        if ($length > 10) {
            throw new InvalidArgumentException('氏名は10文字以内である必要があります。');
        }
    
        if (preg_match('/[^\p{L}\p{N}]/u', $trimmed)) {
            throw new InvalidArgumentException('氏名に記号を含めることはできません。');
        }
    
        $this->value = $trimmed;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
