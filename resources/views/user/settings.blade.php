<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <title>Личный кабинет</title>
</head>
<body>
    <h1>Личный кабинет</h1>
    <p>Добро пожаловать, {{ $user->name }}!</p>

    <h2>Ваши данные:</h2>
    <ul>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Имя:</strong> {{ $user->name }}</li>
        <li><strong>Номер телефона:</strong> {{ $user->phone ?? 'Не указан' }}</li> <!-- Отображаем номер телефона -->
        <li><strong>Дата регистрации:</strong> {{ $user->created_at->format('d.m.Y') }}</li>
    </ul>

    <!-- Форма для изменения данных (например, имя или email) -->
    <form action="{{ route('user.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div>
            <label for="phone">Номер телефона:</label>
            <input type="text" id="phone" name="phone" value="{{ $user->phone }}" placeholder="Введите номер телефона">
        </div>
        <button type="submit">Сохранить изменения</button>
    </form>

    <!-- Кнопка выхода -->
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit">Выйти</button> 
    </form>

</body>
</html>
