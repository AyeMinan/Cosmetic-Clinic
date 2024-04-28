<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="loginbox">
    <h1>管理画面ログイン</h1>
    <form action="/login" method="post">
    @csrf
    <label for="ログインID">ログインID</label>
    <input name="loginId" type="text">
    @error('loginId')
    <p class="text-danger">{{$message}}</p>
    @enderror
    <label for="パスワード">パスワード</label>
    <input name="password" type="password">
    @error('password')
    <p class="text-danger">{{$message}}</p>
    @enderror

    <button class="login" type="submit">ログイン</button>
</form>
</div>

</body>
</html>
