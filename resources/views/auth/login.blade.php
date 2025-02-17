<!DOCTYPE html>
<html lang="ru">
<head>
    @vite(['resources/css/login.css'])
    <title>Авторизация</title>
</head>
<body>

    <div class="logo">
        <img src="{{ asset('images/Logo.svg') }}" alt="Логотип" />
    </div>

    <h1>Авторизация</h1>
    <p>Введите электронную почту и пароль.</p>
    
    @if ($errors->any())
        <div class="error-list">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="input-wrapper">
            <input type="email" name="email" placeholder=" " required>
            <label for="email">Email</label>
        </div>

        <div class="input-wrapper">
            <input type="password" name="password" placeholder=" " required>
            <label for="password">Пароль</label>
        </div>

        <div class="checkbox__wrapper">
            <label class="custom-toggle">
                <input type="checkbox" name="remember" id="remember">
                <span class="slider"></span>
                <div class="text">Запомнить меня</div>
            </label>
        </div>
        

        <button class="submit__auth" type="submit">Войти</button>
    </form>

    <a href="{{ route('register') }}">Нет аккаунта? Зарегистрироваться</a>
</body>
</html>
