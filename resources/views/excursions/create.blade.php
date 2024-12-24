<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить экскурсию</title>
</head>
<body>

<h1>Добавить новую экскурсию</h1>

<form action="{{ route('excursions.store') }}" method="POST" enctype="multipart/form-data"> 
    @csrf
    <label for="title">Название:</label><br>
    <input type="text" id="title" name="title" required><br>

    <label for="description">Описание:</label><br>
    <textarea id="description" name="description" required></textarea><br>

    <label for="price">Цена:</label><br>
    <input type="number" id="price" name="price" step="0.01" required><br><br>

    <label for="duration">Длительность (в минутах):</label><br>
    <input type="number" id="duration" name="duration" required min="1"><br><br> <!-- Добавлено поле длительности -->

    <label for="photo">Изображение:</label><br> 
    <input type="file" id="photo" name="photo" accept="image/*"><br><br>

    <button type="submit">Добавить экскурсию</button>
</form>

<a href="{{ route('excursions.index') }}">Назад к списку экскурсий</a>

</body>
</html>
