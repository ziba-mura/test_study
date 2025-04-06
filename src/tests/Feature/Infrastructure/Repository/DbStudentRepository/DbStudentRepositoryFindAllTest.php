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

class DbStudentRepositoryFindAllTest extends TestCase
{
    use RefreshDatabase;

    public function test_findAllで未削除の生徒がcreated_atの降順で返される()
    {
        $now = CarbonImmutable::now();

        $student1 = new Student(
            id: (string) Str::ulid(),
            name: new Name('山田太郎'),
            hobby: new Hobby('読書'),
            grade: Grade::FIRST,
            isDeleted: false,
            createdAt: $now->subMinutes(10),
            updatedAt: $now->subMinutes(10),
        );

        $student2 = new Student(
            id: (string) Str::ulid(),
            name: new Name('佐藤花子'),
            hobby: new Hobby('音楽'),
            grade: Grade::SECOND,
            isDeleted: false,
            createdAt: $now->subMinutes(5),
            updatedAt: $now->subMinutes(5),
        );

        $deletedStudent = new Student(
            id: (string) Str::ulid(),
            name: new Name('削除太郎'),
            hobby: new Hobby('削除趣味'),
            grade: Grade::THIRD,
            isDeleted: true,
            createdAt: $now->subMinutes(1),
            updatedAt: $now->subMinutes(1),
        );

        $repo = new DbStudentRepository();
        $repo->add($student1);
        $repo->add($student2);
        $repo->add($deletedStudent);

        $results = $repo->findAll();

        $this->assertCount(2, $results); // 削除済みは除外

        // created_at 降順 = 新しい方（佐藤花子）が先
        $this->assertEquals('佐藤花子', (string) $results[0]->getName());
        $this->assertEquals('山田太郎', (string) $results[1]->getName());
    }
}
