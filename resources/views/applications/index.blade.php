<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои Заявки</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .status-pending {
            color: orange;
            border-bottom: 2px dashed orange;
            padding-bottom: 2px; 
        }
        .status-approved {
            color: green;
      
        }
        .status-rejected {
            color: red;
           
        }
        .status-icon {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<h1>Мои Заявки:</h1>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<table style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th style="border: 1px solid black; padding: 8px;">Экскурсия</th>
            <th style="border: 1px solid black; padding: 8px;">Статус</th>
            <th style="border: 1px solid black; padding: 8px;">Действия</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($applications as $application)
            <tr>
                <td style="border: 1px solid black; padding: 8px;">
                    <a href="{{ route('excursions.show', $application->excursion->id) }}">{{ $application->excursion->title }}</a>
                </td>
                <td style="border: 1px solid black; padding: 8px;">
                    @if($application->status === 'В ожидании')
                        <span class="status-pending">
                            <i class="fas fa-clock status-icon"></i> {{ $application->status }}
                        </span>
                    @elseif($application->status === 'Одобрено')
                        <span class="status-approved">
                            <i class="fas fa-check-circle status-icon"></i> {{ $application->status }}
                        </span>
                    @elseif($application->status === 'Отклонено')
                        <span class="status-rejected">
                            <i class="fas fa-times-circle status-icon"></i> {{ $application->status }}
                        </span>
                    @endif
                </td>
                <td style="border: 1px solid black; padding: 8px;">
                    <form action="{{ route('applications.cancel', $application->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Отменить заявку</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" style="border: 1px solid black; padding: 8px;">Нет заявок.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<a href="{{ route('dashboard') }}">Назад на дашборд</a>

</body>
</html>
