<?php

namespace Domain\Student\Repository;

use Domain\Student\Student;

interface StudentRepositoryInterface
{
    public function add(Student $student): Student;
}
