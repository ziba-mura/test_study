<?php

namespace Application\Student;

use Domain\Student\Enum\Grade;

// Studentエンティティデータ受け渡し用クラス
class StudentInputData
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $hobby,
        public readonly Grade $grade,
    ) {}
}
