<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>生徒一覧</title>
</head>
<body>
    <h1>生徒一覧</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th><th>氏名</th><th>趣味</th><th>学年</th><th>登録日時</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->getId() }}</td>
                    <td>{{ $student->getName() }}</td>
                    <td>{{ $student->getHobby() }}</td>
                    <td>{{ $student->getGrade()->label() }}</td>
                    <td>{{ $student->getCreatedAt()->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route(\App\Http\Controllers\Student\AddViewController::class) }}">
        生徒登録
    </a>
</body>
</html>
