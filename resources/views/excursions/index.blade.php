<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>
</head>
<body>
<h1>Список экскурсий</h1>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<a href="{{ route('excursions.create') }}">Добавить новую экскурсию</a>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($excursions as $excursion)
            <tr>
                <td>{{ $excursion->id }}</td>
                <td>{{ $excursion->title }}</td>
                <td>{{ $excursion->description }}</td>
                <td>{{ $excursion->price }}</td>
                <td>
                    <a href="{{ route('excursions.edit', $excursion) }}">Редактировать</a>
                    <form action="{{ route('excursions.destroy', $excursion) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<form action="{{ route('logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit">Выйти</button>
</form>

</body>
</html>
