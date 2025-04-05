<?php

namespace Domain\Student\Repository;

use Illuminate\Support\Collection;
use Domain\Student\Student;

interface StudentRepositoryInterface
{
    public function add(Student $student): Student;
    public function findAll(): Collection;
}
