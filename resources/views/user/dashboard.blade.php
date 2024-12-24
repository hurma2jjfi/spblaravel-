<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
</head>
<body>


    <h1>Вы вошли в систему как пользователь!</h1>
    <p>Добро пожаловать, {{ auth()->user()->name }}</p>
    <h2>Список экскурсий:</h2>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<table style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th style="border: 1px solid black; padding: 8px;">Изображение</th>
            <th style="border: 1px solid black; padding: 8px;">Название</th>
            <th style="border: 1px solid black; padding: 8px;">Описание</th>
            <th style="border: 1px solid black; padding: 8px;">Цена</th>
            <th style="border: 1px solid black; padding: 8px;">Длительность</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($excursions as $excursion)
            <tr>
                <td style="border: 1px solid black; padding: 8px;">
                    @if($excursion->photo)
                        <img src="{{ asset('storage/' . $excursion->photo) }}" alt="{{ $excursion->title }}" style="width: 100px; height: auto;">
                    @else
                        <span>Изображение отсутствует</span>
                    @endif
                </td>
                <td style="border: 1px solid black; padding: 8px;">{{ $excursion->title }}</td>
                <td style="border: 1px solid black; padding: 8px;">{{ $excursion->description }}</td>
                <td style="border: 1px solid black; padding: 8px;">{{ $excursion->price }}₽</td>
                <td style="border: 1px solid black; padding: 8px;">{{ $excursion->duration }}ч.</td>
            </tr>
        @endforeach
    </tbody>
</table>



    <!-- Logout Button -->
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit">Выйти</button> <!-- Logout Button -->
    </form>



</body>
</html>
