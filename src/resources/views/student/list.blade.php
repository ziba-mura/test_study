<?php
use Illuminate\Support\Collection;
use Domain\Student\Student;
/** @var Collection<int, Student> $students */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>生徒一覧</title>
</head>
<body>
    <h1>生徒一覧</h1>
    @if($students->isEmpty())
        <p>生徒が未登録です</p>
    @else
    <table border="1">
        <thead>
            <tr>
                <th>NO.</th><th>氏名</th><th>趣味</th><th>学年</th><th>登録日時</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->getName() }}</td>
                    <td>{{ $student->getHobby() }}</td>
                    <td>{{ $student->getGrade()->label() }}</td>
                    <td>{{ $student->getCreatedAt()->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <a href="{{ route(\App\Http\Controllers\Student\AddViewController::class) }}">
        生徒登録
    </a>
</body>
</html>
