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
    @php
        $userId = request()->segment(2);
        $user = App\Models\User::find($userId);
    @endphp
    <div class="screen">
        <div class="row">
            <x-sidebar></x-sidebar>
            <div class="right">
                <div class="navbar">
                    <div>
                        <h3>アカウント情報</h3>
                    </div>
                </div>


                <div class="newAccount">
                    <div class="emailContainer">
                        <label for="email">メールアドレス</label>
                        <p>{{ $user->email }}</p>
                    </div>
                    <form action="/account/{{ $user->id }}" method="POST">
                        @csrf
                        @method('PUT')
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
                        <button class="saveAccont">アカウントを保存する</button>
                    </form>
                </div>


            </div>
        </div>
    </div>
</body>

</html>
