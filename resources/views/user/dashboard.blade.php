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
        <div class="success-message">{{ session('success') }}</div>
    @endif

    @if(isset($excursions) && $excursions->isEmpty())
        <p class="no-results">Экскурсии не найдены.</p>
    @else
        <div class="excursions-grid">
            @foreach ($excursions as $excursion)
                <div class="excursion-card">
                    <div class="excursion-image">
                        @if($excursion->photo)
                            <img src="{{ asset('storage/' . $excursion->photo) }}" alt="{{ $excursion->title }}">
                        @else
                            <span>Изображение отсутствует</span>
                        @endif
                    </div>
                    <div class="excursion-details">
                        <h3><a href="{{ route('excursions.show', $excursion->id) }}">{{ $excursion->title }}</a></h3>
                        <p>{{ $excursion->description }}</p>
                        <div class="excursion-info">
                            <span>Цена: {{ $excursion->price }}₽</span>
                            <span>Длительность: {{ $excursion->duration }}ч.</span>
                        </div>
                        <form action="{{ route('excursions.apply', $excursion->id) }}" method="POST" class="apply-form">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="status" value="В ожидании">
                            <button class="podat" type="submit">Подать заявку</button>
                        </form>
                        <div class="emoji-reactions">
                            @php
                                $reactions = $excursion->reactions->groupBy('emoji');
                            @endphp
                            <div class="reaction-buttons">
                                @foreach(['👍', '❤️', '😮', '😂', '😢'] as $emoji)
                                    <form action="{{ route('excursions.react', $excursion->id) }}" method="POST">
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
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('logout') }}" method="POST" class="logout-form">
        @csrf
        <button type="submit">Выйти</button> 
    </form>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>