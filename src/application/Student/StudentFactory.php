<?php

namespace Application\Student;

use Domain\Student\Student;
use Domain\Student\ValueObject\Name;
use Domain\Student\ValueObject\Hobby;
use Domain\Student\Enum\Grade;
use Carbon\CarbonImmutable;
use Illuminate\Support\Str;

// Studentエンティティ作成クラス
class StudentFactory
{
    // 登録画面からの新規レコード作成用
    public function forNew(string $name, ?string $hobby, Grade $grade): Student
    {
        $now = CarbonImmutable::now();
        return new Student(
            id: (string) Str::ulid(),
            name: new Name($name),
            hobby: new Hobby($hobby),
            grade: $grade,
            isDeleted: false,
            createdAt: $now,
            updatedAt: $now,
        );
    }
}
