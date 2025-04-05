<?php

namespace Tests\Unit\domain\Student\ValueObject;

use PHPUnit\Framework\TestCase;
use domain\Student\ValueObject\Hobby;
use InvalidArgumentException;

class HobbyTest extends TestCase
{
    public function test_趣味がnullでもインスタンス生成できる()
    {
        $hobby = new Hobby(null);
        $this->assertEquals('', $hobby);
    }

    public function test_趣味が空文字でもOK()
    {
        $hobby = new Hobby('   ');
        $this->assertEquals('', $hobby);
    }

    public function test_趣味が半角100文字ちょうどならOK()
    {
        $valid = str_repeat('a', 100);
        $hobby = new Hobby($valid);
        $this->assertEquals($valid, $hobby);
    }

    public function test_趣味が半角101文字なら例外()
    {
        $this->expectException(InvalidArgumentException::class);
        $invalid = str_repeat('a', 101);
        new Hobby($invalid);
    }

    public function test_趣味が全角100文字ちょうどならOK()
    {
        $valid = str_repeat('あ', 100);
        $hobby = new Hobby($valid);
        $this->assertEquals($valid, $hobby);
    }

    public function test_趣味が全角101文字なら例外()
    {
        $this->expectException(InvalidArgumentException::class);
        $invalid = str_repeat('あ', 101);
        new Hobby($invalid);
    }

    public function test_趣味が半角全角100文字ちょうどならOK()
    {
        $valid = str_repeat('a', 50) . str_repeat('あ', 50);
        $hobby = new Hobby($valid);
        $this->assertEquals($valid, $hobby);
    }

    public function test_趣味が半角全角101文字なら例外()
    {
        $this->expectException(InvalidArgumentException::class);
        $invalid = str_repeat('a', 50) . str_repeat('あ', 51);
        new Hobby($invalid);
    }

    public function test_前後に空白がある場合はトリムされる()
    {
        $hobby = new Hobby('  読書  ');
        $this->assertEquals('読書', $hobby);
    }
}
