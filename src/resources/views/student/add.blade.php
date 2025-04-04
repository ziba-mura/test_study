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
                <option value="1">1年</option>
                <option value="2">2年</option>
                <option value="3">3年</option>
            </select>
        </div>
        <button type="submit">登録</button>
    </form>
</body>
</html>
