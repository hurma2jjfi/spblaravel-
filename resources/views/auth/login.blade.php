<!DOCTYPE html>
<html>
<head>
    <title>Авторизация</title>
</head>
<body>
    <h1>Авторизация</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Войти</button>
    </form>

    <a href="{{ route('register') }}">Нет аккаунта? Зарегистрироваться</a>
</body>
</html>
