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
            'name' => '山田太郎',
            'hobby' => '読書',
            'grade' => Grade::FIRST->value,
        ]);

        $response->assertRedirect('/student/add');
        $response->assertSessionHas('success', '登録成功！');

        $this->assertDatabaseHas('students', [
            'name' => '山田太郎',
            'hobby' => '読書',
            'grade' => Grade::FIRST->value,
            'is_deleted' => 0,
        ]);
    }
}
