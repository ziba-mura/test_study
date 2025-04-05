<!-- resources/views/student/add.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>生徒登録</title>
</head>
<body>
    <h1>生徒登録フォーム</h1>
    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif
    <form action="#" method="POST">
        @csrf
        <div>
            <label>氏名：</label>
            <input type="text" name="name">
        </div>
        <div>
            <label>趣味：</label>
            <input type="text" name="hobby">
        </div>
        <div>
            <label>学年：</label>
            <select name="grade">
            @foreach (\domain\Student\Enum\Grade::cases() as $grade)
                    <option value="{{ $grade->value }}">{{ $grade->label() }}</option>
                @endforeach
            </select>            
        </div>
        <button type="submit">登録</button>
    </form>
    <a href="{{ route(\App\Http\Controllers\Student\ListController::class) }}">
        一覧へ
    </a>
</body>
</html>
