<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $excursion->title }}</title>
</head>
<body>

<h1>{{ $excursion->title }}</h1>
<img src="{{ asset('storage/' . $excursion->photo) }}" alt="{{ $excursion->title }}" style="width: 300px; height: auto;">
<p>{{ $excursion->description }}</p>
<p>Цена: {{ $excursion->price }}₽</p>
<p>Длительность: {{ $excursion->duration }}ч.</p>

<h2>Подать заявку на экскурсию</h2>
<form action="{{ route('excursions.apply', $excursion->id) }}" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    <input type="hidden" name="status" value="В ожидании">
    
    <button type="submit">Отправить заявку</button>
</form>

<!-- Кнопка выхода -->
<a href="{{ route('dashboard') }}" style="display:inline;">
    <button type="button">Назад</button>
</a>


</body>
</html>
