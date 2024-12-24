<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> <!-- Подключение Bootstrap -->
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
    <h1 class="text-center mb-4">Список экскурсий:</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="text-right mb-3">
        <a href="{{ route('excursions.create') }}" class="btn btn-primary">Добавить новую экскурсию</a>
    </div>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Изображение</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Цена</th>
                <th>Длительность</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($excursions as $excursion)
                <tr>
                    <td>
                        @if($excursion->photo)
                            <img src="{{ asset('storage/' . $excursion->photo) }}" alt="{{ $excursion->title }}" class="img-thumbnail" style="width: 100px; height: auto;">
                        @else
                            <span>Изображение отсутствует</span>
                        @endif
                    </td>
                    <td>{{ $excursion->title }}</td>
                    <td>{{ $excursion->description }}</td>
                    <td>{{ $excursion->price }}₽</td>
                    <td>{{ $excursion->duration }}ч.</td>
                    <td>
                        <a href="{{ route('excursions.edit', $excursion) }}" class="btn btn-warning btn-sm">Редактировать</a>
                        <form action="{{ route('excursions.destroy', $excursion) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mt-3">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Logout Button Positioned at the Bottom -->
    <div class="d-flex justify-content-end mt-3">
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Выйти</button> <!-- Logout Button -->
        </form>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
