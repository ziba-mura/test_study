<?php

namespace Infrastructure\Repository;

use Illuminate\Support\Facades\DB;
use Domain\Student\Student;
use Domain\Student\Repository\StudentRepositoryInterface;

class DbStudentRepository implements StudentRepositoryInterface
{
    public function add(Student $student): Student
    {
        $id = DB::table('students')->insertGetId([
            'name'        => $student->getName(),
            'hobby'       => $student->getHobby(),
            'grade'       => $student->getGrade()->value,
            'is_deleted'  => $student->isDeleted(),
            'created_at'  => $student->getCreatedAt(),
            'updated_at'  => $student->getUpdatedAt(),
        ]);

        return $student->withId($id);
    }
}
