<?php

namespace App\Http\Controllers\Student;

use Application\Student\AddService;
use Application\Student\StudentInputData;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Student\Request\AddRequest;

// 生徒登録用コントローラー
class AddController extends Controller
{
    public function __invoke(AddRequest $request, AddService $addService)
    {
        $input = new StudentInputData(
            name: $request->getName(),
            hobby: $request->getHobby(),
            grade: $request->getGrade(),
        );

        $addService->execute($input);
        return redirect()->route(AddController::class)->with('success', '登録成功！');
    }
}