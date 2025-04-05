<?php

namespace Tests\Unit\domain\Student\ValueObject;

use PHPUnit\Framework\TestCase;
use domain\Student\ValueObject\Name;
use InvalidArgumentException;

class NameTest extends TestCase
{
    public function test_正常な名前ならインスタンス生成できる()
    {
        $name = new Name('山田太郎');
        $this->assertEquals('山田太郎', (string) $name);
    }

    public function test_前後に空白があってもトリムされる()
    {
        $name = new Name('  山田太郎  ');
        $this->assertEquals('山田太郎', (string) $name);
    }

    public function test_空文字なら例外()
    {
        $this->expectException(InvalidArgumentException::class);
        new Name('');
    }

    public function test_1文字しかない場合は例外()
    {
        $this->expectException(InvalidArgumentException::class);
        new Name('太');
    }

    public function test_記号が含まれていたら例外()
    {
        $this->expectException(InvalidArgumentException::class);
        new Name('山田$太郎');
    }

    public function test_全角10文字ちょうどならOK()
    {
        $name = new Name('一二三四五六七八九十');
        $this->assertEquals('一二三四五六七八九十', (string) $name);
    }

    public function test_全角11文字以上は例外()
    {
        $this->expectException(InvalidArgumentException::class);
        new Name('一二三四五六七八九十一');
    }

    public function test_半角10文字ちょうどならOK()
    {
        $name = new Name('12345abcde');
        $this->assertEquals('12345abcde', (string) $name);
    }

    public function test_半角11文字以上は例外()
    {
        $this->expectException(InvalidArgumentException::class);
        new Name('12345abcdef');
    }

    public function test_半角全角混じりで10文字ちょうどならOK()
    {
        $name = new Name('田2345abcd中');
        $this->assertEquals('田2345abcd中', (string) $name);
    }

    public function test_半角全角混じり11文字以上は例外()
    {
        $this->expectException(InvalidArgumentException::class);
        new Name('田12345abcd中');
    }
}
