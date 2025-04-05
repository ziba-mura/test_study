<?php

namespace Tests\Unit\Application\Student;

use Tests\TestCase;
use Application\Student\AddService;
use Application\Student\StudentFactory;
use Application\Student\StudentInputData;
use Domain\Student\Student;
use Domain\Student\Enum\Grade;
use Domain\Student\Repository\StudentRepositoryInterface;
use Mockery;

class AddServiceTest extends TestCase
{
    public function test_正常に生徒が登録される()
    {
        // Arrange
        $input = new StudentInputData(
            name: '山田太郎',
            hobby: '読書',
            grade: Grade::FIRST
        );

        $dummyStudent = Mockery::mock(Student::class);

        $factory = Mockery::mock(StudentFactory::class);
        $factory->shouldReceive('forNew')
            ->with('山田太郎', '読書', Grade::FIRST)
            ->andReturn($dummyStudent);

        $repository = Mockery::mock(StudentRepositoryInterface::class);
        $repository->shouldReceive('add')
            ->with($dummyStudent)
            ->andReturn($dummyStudent);

        $addService = new AddService($factory, $repository);

        // Act
        $result = $addService->execute($input);

        // Assert
        $this->assertSame($dummyStudent, $result);
    }
}
