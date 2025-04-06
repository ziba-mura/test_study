<?php

namespace Tests\Feature\Infrastructure\RepositoryDbStudentRepository;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Infrastructure\Repository\DbStudentRepository;
use Domain\Student\Student;
use Domain\Student\ValueObject\Name;
use Domain\Student\ValueObject\Hobby;
use Domain\Student\Enum\Grade;
use Carbon\CarbonImmutable;
use Illuminate\Support\Str;

class DbStudentRepositoryAddTest extends TestCase
{
    use RefreshDatabase;

    public function test_addで生徒情報が正しく保存される()
    {
        $ulid = (string) Str::ulid();

        $student = new Student(
            id: $ulid,
            name: new Name('山田太郎'),
            hobby: new Hobby('読書'),
            grade: Grade::FIRST,
            isDeleted: false,
            createdAt: CarbonImmutable::now(),
            updatedAt: CarbonImmutable::now(),
        );

        $repository = new DbStudentRepository();
        $repository->add($student);

        $this->assertDatabaseHas('students', [
            'id' => $ulid,
            'name' => '山田太郎',
            'hobby' => '読書',
            'grade' => 1,
            'is_deleted' => 0,
        ]);
    }
}
