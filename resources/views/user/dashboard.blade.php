<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/dashboard.css'])
    <title>Главная</title>
</head>
<body>

    <h1>Вы вошли в систему как пользователь!</h1>
    <p>Добро пожаловать, {{ auth()->user()->name }}</p>
    <p><a href="{{ route('user.settings') }}">Личный кабинет</a></p>
    <p><a href="{{ route('applications.index') }}">Мои заявки</a></p>

    <!-- Форма поиска -->
    <form action="{{ route('excursions.search') }}" method="GET">
        <input type="text" name="query" placeholder="Поиск экскурсий" required>
        <button type="submit">Поиск</button>
    </form>

    <h2>Список экскурсий:</h2>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if(isset($excursions) && $excursions->isEmpty())
        <p>Экскурсии не найдены.</p>
    @else
        <table style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th style="border: 1px solid black; padding: 8px;">Изображение</th>
                    <th style="border: 1px solid black; padding: 8px;">Название</th>
                    <th style="border: 1px solid black; padding: 8px;">Описание</th>
                    <th style="border: 1px solid black; padding: 8px;">Цена</th>
                    <th style="border: 1px solid black; padding: 8px;">Длительность</th>
                    <th style="border: 1px solid black; padding: 8px;">Действия</th>
                    <th style="border: 1px solid black; padding: 8px;">Реакции</th>
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
                        <td style="border: 1px solid black; padding: 8px;">
                            <a href="{{ route('excursions.show', $excursion->id) }}">{{ $excursion->title }}</a>
                        </td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $excursion->description }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $excursion->price }}₽</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $excursion->duration }}ч.</td>
                        <td style="border: 1px solid black; padding: 8px;">
                            <form action="{{ route('excursions.apply', $excursion->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="status" value="В ожидании">
                                <button type="submit">Подать заявку</button>
                            </form>
                        </td>
                        <td style="border: 1px solid black; padding: 8px;">
                            <div class="emoji-reactions">
                                @php
                                    $reactions = $excursion->reactions->groupBy('emoji');
                                @endphp
                                
                                <div class="reaction-buttons">
                                    @foreach(['👍', '❤️', '😮', '😂', '😢'] as $emoji)
                                        <form action="{{ route('excursions.react', $excursion->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="emoji" value="{{ $emoji }}">
                                            <button class="emoji" type="submit">
                                                {{ $emoji }} 
                                                <span class="reaction-count">
                                                    {{ $reactions->get($emoji)?->count() ?? 0 }}
                                                </span>
                                            </button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif


    
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit">Выйти</button> 
    </form>




<script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
