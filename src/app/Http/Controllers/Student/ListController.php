<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Domain\Student\Repository\StudentRepositoryInterface;

class ListController extends Controller
{
    public function __invoke(StudentRepositoryInterface $studentRepository)
    {
        $students = $studentRepository->findAll();

        return view('student.list', compact('students'));
    }
}
