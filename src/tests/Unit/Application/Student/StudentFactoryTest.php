<?php

namespace Tests\Unit\Application\Student;

use Tests\TestCase;
use Application\Student\StudentFactory;
use Domain\Student\Enum\Grade;
use Domain\Student\Student;
use Carbon\CarbonImmutable;

class StudentFactoryTest extends TestCase
{
    public function test_forNewで正しくStudentエンティティが生成される()
    {
        $factory = new StudentFactory();

        $name = '山田太郎';
        $hobby = 'ピアノ';
        $grade = Grade::SECOND;

        // 時刻固定（forNew内のcreatedAt, updatedAt との比較のため）
        $now = CarbonImmutable::now();
        CarbonImmutable::setTestNow($now);

        $student = $factory->forNew($name, $hobby, $grade);

        // 検証
        $this->assertInstanceOf(Student::class, $student);
        $this->assertMatchesRegularExpression('/^[0-9A-HJKMNP-TV-Z]{26}$/', $student->getId()); //ULID比較用
        $this->assertEquals($name, (string) $student->getName());
        $this->assertEquals($hobby, (string) $student->getHobby());
        $this->assertEquals($grade, $student->getGrade());
        $this->assertFalse($student->isDeleted());
        $this->assertEquals($now, $student->getCreatedAt());
        $this->assertEquals($now, $student->getUpdatedAt());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        CarbonImmutable::setTestNow(); // リセット
    }
}
