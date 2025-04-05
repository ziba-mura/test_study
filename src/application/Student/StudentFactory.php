<?php

namespace Application\Student;

use Domain\Student\Student;
use Domain\Student\ValueObject\Name;
use Domain\Student\ValueObject\Hobby;
use Domain\Student\Enum\Grade;
use Carbon\CarbonImmutable;

// Studentエンティティ作成クラス
class StudentFactory
{
    // 登録画面からの新規レコード作成用
    public function forNew(string $name, ?string $hobby, Grade $grade): Student
    {
        return new Student(
            id: null,
            name: new Name($name),
            hobby: new Hobby($hobby),
            grade: $grade,
            isDeleted: false,
            createdAt: CarbonImmutable::now(),
            updatedAt: CarbonImmutable::now(),
        );
    }
}
