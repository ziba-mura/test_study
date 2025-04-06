<?php

namespace Tests\Feature\Student;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Domain\Student\Student;
use Domain\Student\ValueObject\Name;
use Domain\Student\ValueObject\Hobby;
use Domain\Student\Enum\Grade;
use Illuminate\Support\Str;
use Carbon\CarbonImmutable;
use Infrastructure\Repository\DbStudentRepository;

class ListControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_生徒の登録がない場合は生徒が未登録ですが表示される()
    {
        $response = $this->get('/student');

        $response->assertStatus(200);
        $response->assertSee('生徒が未登録です');
    }

    public function test_未削除の生徒の登録がある場合は生徒が未登録ですが表示されない()
    {
        $now = CarbonImmutable::now();

        $student = new Student(
            id: (string) Str::ulid(),
            name: new Name('山田太郎'),
            hobby: new Hobby('読書'),
            grade: Grade::FIRST,
            isDeleted: false,
            createdAt: $now->subMinutes(10),
            updatedAt: $now->subMinutes(10),
        );

        $repo = new DbStudentRepository();
        $repo->add($student);

        $response = $this->get('/student');
        $response->assertStatus(200);
        $response->assertDontSee('生徒が未登録です');
    }

    public function test_削除済の生徒の登録のみ場合は生徒が未登録ですが表示される()
    {
        $now = CarbonImmutable::now();

        $deleted = new Student(
            id: (string) Str::ulid(),
            name: new Name('削除太郎'),
            hobby: new Hobby('ゲーム'),
            grade: Grade::SECOND,
            isDeleted: true, //削除済み
            createdAt: $now->subMinutes(5),
            updatedAt: $now->subMinutes(5),
        );
        $repo = new DbStudentRepository();
        $repo->add($deleted);

        $response = $this->get('/student');
        $response->assertStatus(200);
        $response->assertSee('生徒が未登録です');
    }

    public function test_一覧画面で未削除の生徒が表示される()
    {
        $now = CarbonImmutable::now();

        $deleted = new Student(
            id: (string) Str::ulid(),
            name: new Name('削除太郎'),
            hobby: new Hobby('ゲーム'),
            grade: Grade::SECOND,
            isDeleted: true, //削除済み
            createdAt: $now->subMinutes(5),
            updatedAt: $now->subMinutes(5),
        );

        $student = new Student(
            id: (string) Str::ulid(),
            name: new Name('山田太郎'),
            hobby: new Hobby('読書'),
            grade: Grade::FIRST,
            isDeleted: false, //未削除
            createdAt: $now->subMinutes(10),
            updatedAt: $now->subMinutes(10),
        );

        $repo = new DbStudentRepository();
        $repo->add($deleted);
        $repo->add($student);

        $response = $this->get('/student');

        $response->assertStatus(200);
        $response->assertSee('山田太郎');

        $response->assertDontSee('削除太郎'); // 削除済みは出ない
    }

    public function test_一覧画面で登録日時の降順で生徒が表示される()
    {
        $now = CarbonImmutable::now();

        $firstAddedStudent = new Student(
            id: (string) Str::ulid(),
            name: new Name('山田太郎'),
            hobby: new Hobby('読書'),
            grade: Grade::FIRST,
            isDeleted: false,
            createdAt: $now->subMinutes(10),
            updatedAt: $now->subMinutes(10),
        );

        $secondAddedStudent = new Student(
            id: (string) Str::ulid(),
            name: new Name('佐藤花子'),
            hobby: new Hobby('ゲーム'),
            grade: Grade::SECOND,
            isDeleted: false,
            createdAt: $now->subMinutes(5),
            updatedAt: $now->subMinutes(5),
        );

        $repo = new DbStudentRepository();
        $repo->add($firstAddedStudent);
        $repo->add($secondAddedStudent);

        $response = $this->get('/student');
        $response->assertStatus(200);

        $response->assertSee('佐藤花子');
        $response->assertSee('山田太郎');

        // 表示順の保証（位置で確認）
        $posFirstAddedStudent = strpos($response->getContent(), '山田太郎');
        $posSecondAddedStudent= strpos($response->getContent(), '佐藤花子');
        $this->assertTrue($posSecondAddedStudent < $posFirstAddedStudent); // 後に追加された佐藤花子が先に表示される
    }
}
