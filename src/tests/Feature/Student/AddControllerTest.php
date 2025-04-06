<?php

namespace Tests\Feature\Student;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Domain\Student\Enum\Grade;

class AddControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_正しいデータを送信すると登録される()
    {
        $response = $this->post('/student/add', [
            'name' => str_repeat('あ', 10),
            'hobby' => str_repeat('あ', 100),
            'grade' => Grade::FIRST->value,
        ]);

        $response->assertRedirect('/student/add');
        $response->assertSessionHas('success', '登録成功！');

        $this->assertDatabaseHas('students', [
            'name' => str_repeat('あ', 10),
            'hobby' => str_repeat('あ', 100),
            'grade' => Grade::FIRST->value,
            'is_deleted' => 0,
        ]);
    }

    public function test_趣味が空でも正しいデータを送信すると登録される()
    {
        $response = $this->post('/student/add', [
            'name' => '山田太郎',
            'hobby' => null,
            'grade' => Grade::FIRST->value,
        ]);

        $response->assertRedirect('/student/add');
        $response->assertSessionHas('success', '登録成功！');

        $this->assertDatabaseHas('students', [
            'name' => '山田太郎',
            'hobby' => '',
            'grade' => Grade::FIRST->value,
            'is_deleted' => 0,
        ]);
    }

    public function test_名前が空の場合はバリデーションエラーになる()
    {
        $response = $this->from('/student/add')->post('/student/add', [
            'name' => '',
            'hobby' => 'テスト趣味',
            'grade' => Grade::FIRST->value,
        ]);
    
        $response->assertRedirect('/student/add');
        $response->assertSessionHasErrors('name');
    }    

    public function test_名前が11文字以上ならバリデーションエラー()
    {
        $response = $this->from('/student/add')->post('/student/add', [
            'name' => str_repeat('あ', 11),
            'hobby' => '将棋',
            'grade' => Grade::SECOND->value,
        ]);
    
        $response->assertRedirect('/student/add');
        $response->assertSessionHasErrors('name');
    }    

    public function test_趣味が101文字以上ならバリデーションエラー()
    {
        $response = $this->from('/student/add')->post('/student/add', [
            'name' => '山田太郎',
            'hobby' => str_repeat('あ', 101),
            'grade' => Grade::SECOND->value,
        ]);
    
        $response->assertRedirect('/student/add');
        $response->assertSessionHasErrors('hobby');
    }    


    public function test_学年に不正な値を指定するとバリデーションエラー()
    {
        $response = $this->from('/student/add')->post('/student/add', [
            'name' => '佐藤次郎',
            'hobby' => 'ラジコン',
            'grade' => 99, // 不正な値
        ]);
    
        $response->assertRedirect('/student/add');
        $response->assertSessionHasErrors('grade');
    }    
}
