<?php

namespace Tests\Unit\domain\Student\Enum;

use PHPUnit\Framework\TestCase;
use domain\Student\Enum\Grade;
use ValueError;

class GradeTest extends TestCase
{
    public function test_Gradeのfromで各値が正しくEnum化される()
    {
        $this->assertSame(Grade::FIRST, Grade::from(1));
        $this->assertSame(Grade::SECOND, Grade::from(2));
        $this->assertSame(Grade::THIRD, Grade::from(3));
    }

    public function test_labelメソッドで正しいラベルが返る()
    {
        $this->assertEquals('1年', Grade::FIRST->label());
        $this->assertEquals('2年', Grade::SECOND->label());
        $this->assertEquals('3年', Grade::THIRD->label());
    }

    public function test_valuesメソッドで正しい配列が返る()
    {
        $this->assertEquals([1, 2, 3], Grade::values());
    }

    public function test_fromで不正な値を渡すとValueErrorがスローされる()
    {
        $this->expectException(ValueError::class);
        Grade::from(4);
    }
}
