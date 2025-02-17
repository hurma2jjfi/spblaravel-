<!DOCTYPE html>
<html lang="ru">
<head>
    @vite(['resources/css/register.css'])
    <title>Регистрация</title>
</head>
<body>

    <div class="logo">
        <img src="{{ asset('images/Logo.svg') }}" alt="Логотип" />
    </div>

    <h1>Регистрация</h1>
    
    @if ($errors->any())
        <div class="error-list">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="input-wrapper">
            <input type="text" name="name" placeholder=" " required>
            <label for="name">Имя</label>
        </div>

        <div class="input-wrapper">
            <input type="email" name="email" placeholder=" " required>
            <label for="email">Email</label>
        </div>

        <div class="input-wrapper">
            <input id="phone__mask" type="text" name="phone" placeholder=" " required>
            <label for="phone">Номер телефона</label>
        </div>

        <div class="input-wrapper">
            <input type="password" name="password" placeholder=" " required>
            <label for="password">Пароль</label>
        </div>

        <div class="input-wrapper">
            <input type="password" name="password_confirmation" placeholder=" " required>
            <label for="password_confirmation">Подтверждение пароля</label>
        </div>

        <button class="submit__auth" type="submit">Зарегистрироваться</button>
    </form>

    <a href="{{ route('login') }}">Уже есть аккаунт? Войти</a>




    
<script src="{{ asset('js/register.js') }}"></script>
</body>
</html>
