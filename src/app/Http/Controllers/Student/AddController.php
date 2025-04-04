<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Student\Request\AddRequest;

class AddController extends Controller
{
    public function __invoke(AddRequest $request)
    {
        // あとで保存処理をここに書く
        return redirect('/student/add')->with('success', '登録成功！');
    }
}