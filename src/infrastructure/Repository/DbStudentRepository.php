<?php

namespace Infrastructure\Repository;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Domain\Student\Student;
use Domain\Student\ValueObject\Name;
use Domain\Student\ValueObject\Hobby;
use Domain\Student\Enum\Grade;
use Domain\Student\Repository\StudentRepositoryInterface;

class DbStudentRepository implements StudentRepositoryInterface
{
    public function add(Student $student): Student
    {
        DB::table('students')->insert([
            'id'          => $student->getId(),
            'name'        => $student->getName(),
            'hobby'       => $student->getHobby(),
            'grade'       => $student->getGrade()->value,
            'is_deleted'  => $student->isDeleted(),
            'created_at'  => $student->getCreatedAt(),
            'updated_at'  => $student->getUpdatedAt(),
        ]);

        return $student;
    }

    public function findAll(): Collection
    {
        $rows = DB::table('students')
            ->where('is_deleted', false)
            ->orderBy('id', 'desc')
            ->get();

        return $rows->map(function ($row) {
            return new Student(
                id: $row->id,
                name: new Name($row->name),
                hobby: new Hobby($row->hobby),
                grade: Grade::from($row->grade),
                isDeleted: $row->is_deleted,
                createdAt: new CarbonImmutable($row->created_at),
                updatedAt: new CarbonImmutable($row->updated_at),
            );
        });
    }
}
