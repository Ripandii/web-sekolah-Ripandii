<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
</head>
<body>

    <h1>Login Admin</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('magic_link'))
        <p style="color: blue;">
            Klik link berikut untuk login:<br>
            <a href="{{ session('magic_link') }}">{{ session('magic_link') }}</a>
        </p>
    @endif

    @if($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('admin.magic-login.send') }}">
        @csrf
        <input type="email" name="email" placeholder="Email admin" required>
        <button type="submit">Kirim Link Login</button>
    </form>

</body>
</html>