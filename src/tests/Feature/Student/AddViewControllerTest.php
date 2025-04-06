<?php

namespace Tests\Feature\Student;

use Tests\TestCase;

class AddViewControllerTest extends TestCase
{
    public function test_add画面が表示される()
{
    $response = $this->get('/student/add');
    $response->assertStatus(200);
    $response->assertViewIs('student.add');
}
}
