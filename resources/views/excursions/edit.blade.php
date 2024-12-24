<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать экскурсию</title>
</head>
<body>

<h1>Редактировать экскурсию</h1>

<form action="{{ route('excursions.update', $excursion) }}" method="POST" enctype="multipart/form-data"> 
    @csrf
    @method('PUT')
    
    <label for="title">Название:</label><br>
    <input type="text" id="title" name="title" value="{{ $excursion->title }}" required><br>

    <label for="description">Описание:</label><br>
    <textarea id="description" name="description" required>{{ $excursion->description }}</textarea><br>

    <label for="price">Цена:</label><br>
    <input type="number" id="price" name="price" value="{{ $excursion->price }}" step="0.01" required><br><br>

    <label for="duration">Длительность (в часах):</label><br>
    <input type="number" id="duration" name="duration" value="{{ $excursion->duration }}" required min="1"><br><br> <!-- Добавлено поле длительности -->

    <label for="photo">Изображение:</label><br>
    <input type="file" id="photo" name="photo" accept="image/*"><br><br> 

    <button type="submit">Обновить экскурсию</button>
</form>

<a href="{{ route('excursions.index') }}">Назад к списку экскурсий</a>

</body>
</html>
