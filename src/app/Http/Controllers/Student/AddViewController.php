<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// 生徒登録画面用コントローラー
class AddViewController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('student.add');
    }
}