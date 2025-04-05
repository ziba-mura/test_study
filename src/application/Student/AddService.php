<?php

namespace Application\Student;

use Domain\Student\Student;
use Domain\Student\Repository\StudentRepositoryInterface;
use Application\Student\StudentFactory;

// 新規生徒登録サービス
class AddService
{
    public function __construct(
        private StudentFactory $factory,
        private StudentRepositoryInterface $repository,
    ) {}

    public function execute(StudentInputData $input): Student
    {
        $student = $this->factory->forNew(
            name: $input->name,
            hobby: $input->hobby,
            grade: $input->grade
        );

        return $this->repository->add($student);
    }
}
