<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <h3>アカウント情報</h3>

                    </div>
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                </div>
                <p class="emailAddress">メールアドレス</p>
                @foreach ($users as $user)
                    <div class="accountTable">
                        <div>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div class="buttongp">
                            <a href="/account/{{ $user->id }}/edit"><button
                                    class="changePassword">パスワード変更</button></a>
                            <form id="deleteForm{{ $user->id }}" action="/account/{{ $user->id }}"
                                method="POST">
                                @csrf
                                @method('delete')
                                <button type="button" class="deleteBtn"
                                    onclick="confirmDelete('{{ $user->email }}', '{{ $user->id }}')">削除</button>
                            </form>
                        </div>

                    </div>
                @endforeach
                <div class="addAccountContainer">
                    <a href="/account/create"><button class="addAccount">アカウントを追加する</button></a>
                </div>
            </div>
        </div>
        <x-modal></x-modal>
</body>
<script>
    function confirmDelete(userEmail, id) {
        var confirmationText = 'test.jpの内容\n\n' + 'Are you user you want to delete this email?\n' + userEmail;

        document.getElementById('confirmationText').innerText = confirmationText;
        document.getElementById('confirmationModal').style.display = 'block';

        document.getElementById('confirmButton').onclick = function() {
            document.getElementById('deleteForm' + id).submit();
        }
        document.getElementById('cancelButton').onclick = function() {
            document.getElementById('confirmationModal').style.display = 'none';
        }
    }
</script>

</html>
