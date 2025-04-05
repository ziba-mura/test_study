<?php

namespace Application\Student;

use Domain\Student\Student;
use Application\Student\StudentFactory;

// 新規生徒登録サービス
class AddService
{
    public function __construct(
        private StudentFactory $factory,
    ) {}

    public function execute(StudentInputData $input): Student
    {
        $name = $input->name;
        $hobby = $input->hobby;
        $grade = $input->grade;

        $student = $this->factory->forNew(
            name: $name,
            hobby: $hobby,
            grade: $grade
        );

        // 永続化処理

        return $student;
    }
}
