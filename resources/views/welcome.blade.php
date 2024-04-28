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
    <div class="screen">
        <div class="row">
         <x-sidebar></x-sidebar>
            <div class="right">
                <div class="navbar">
                    <div>
                    <a href="/"><h3>ホーム</h3></a>
                </div>
                <div class="items">
                    @if (auth()->user())
                    <h3>{{auth()->user()->email}}</h3>
                    @endif
                   <h3>さん</h3>
                   <form action="/logout" method="POST">
                    @csrf
                   <button type="submit" class="logout">ログアウト</button>
                </form>
                </div>
                </div>
                <div class="main">
                    <a href="/time"><h3 class="time">診察時間編集</h3></a>
                    <a href="/vacation"><h3 class="setting">長期休業設定</h3></a>
                    <a href="/account"><h3 class="accountInfo">アカウント情報</h3></a>
            </div>
            </div>
            </div>
        </div>

</body>
</html>
