<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Document</title>
</head>

<body>

    <div class="screen">
        <div class="row">
            <x-sidebar></x-sidebar>

            <div class="right">
                <div class="navbar">
                    <div>
                        <h3>アカウント情報</h3>
                    </div>
                </div>
                <div>
                    <div class="newAccount">
                        <form action="/account" method="POST">
                            @csrf
                            <label for="email">メールアドレス</label>
                            <input name="email" type="text">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <label for="password">パスワード</label>
                            <input name="password" type="password">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <label for="confirm_password">パスワード（確認）</label>
                            <input name="confirm_password" type="password">
                            @error('confirm_password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            <button type="submit" class="saveAccont">アカウントを保存する</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

</body>


</html>
