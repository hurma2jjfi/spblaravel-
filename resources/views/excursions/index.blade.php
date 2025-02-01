<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Панель администратора</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    @vite('resources/css/dashboard.css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> 
</head>
<body class="bg-dark text-white">
<header class="vertical-header bg-primary text-white d-flex flex-column justify-content-between align-items-center" style="position: fixed; top: 0; left: 0; width: 200px; height: 100vh;">
    <div class="admin__icon mt-3">
        <img src="{{ asset('images/Group (1).svg') }}" alt="Admin Icon" class="admin-icon">
    </div>

    <div class="d-flex justify-content-end mb-3">
    @if(Auth::check())
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-danger logout-btn">Выйти</button>
        </form>
    @endif
</div>

</header>

<div class="container mt-5">
    <h1 class="text-center mb-4">Список экскурсий:</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="text-right mb-3">
        <a href="{{ route('excursions.create') }}" class="btn btn-primary">Добавить экскурсию</a>
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
                            <img src="{{ asset('storage/' . $excursion->photo) }}" alt="{{ $excursion->title }}" class="img-thumbnail" style="width: 100px; height: auto; padding: 0;
    background-color: transparent;
    border: none;
    border-radius: 0;
    max-width: none;
    height: auto; ">
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

    
    <div class="d-flex justify-content-center mt-3">
        {{ $excursions->links('vendor.pagination.bootstrap-4') }} 
    </div>


    <div class="row mt-5">
        <div class="col-12">
            <h2 class="text-center mb-4">Заявки пользователей</h2>
            
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Пользователь</th>
                        <th>Экскурсия</th>
                        <th>Дата</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                        <tr>
                            
                            <td>{{ $application->user->name }}</td>
                            <td>{{ $application->excursion->title }}</td>
                            <td>{{ $application->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                <select class="form-control status-select" 
                                        data-application-id="{{ $application->id }}">
                                    <option value="В ожидании" 
                                        {{ $application->status == 'pending' ? 'selected' : '' }}>
                                        В ожидании
                                    </option>
                                    <option value="Одобрено" 
                                        {{ $application->status == 'approved' ? 'selected' : '' }}>
                                        Одобрено
                                    </option>
                                    <option value="Отклонено" 
                                        {{ $application->status == 'rejected' ? 'selected' : '' }}>
                                        Отклонено
                                    </option>
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-application" 
                                        data-application-id="{{ $application->id }}">
                                    Удалить
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    
            <div class="d-flex justify-content-center mt-3">
                {{ $applications->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>

</div>





<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Обработчик изменения статуса заявки
    const statusSelects = document.querySelectorAll('.status-select');
    statusSelects.forEach(select => {
        select.addEventListener('change', function() {
            const applicationId = this.dataset.applicationId;
            const newStatus = this.value;

            fetch(`/applications/${applicationId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    status: newStatus
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ошибка обновления статуса');
                }
                showAlert('success', 'Статус обновлен');
            })
            .catch(error => {
                showAlert('error', 'Ошибка обновления статуса');
            });
        });
    });

    // Обработчик удаления заявки
    const deleteButtons = document.querySelectorAll('.delete-application');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const applicationId = this.dataset.applicationId;

            // Показ диалога подтверждения
            showConfirmDialog('Удаление заявки', 'Вы уверены, что хотите удалить заявку?', () => {
                fetch(`/applications/${applicationId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Ошибка удаления заявки');
                    }
                    showAlert('success', 'Заявка удалена', () => {
                        location.reload();
                    });
                })
                .catch(error => {
                    showAlert('error', 'Ошибка удаления заявки');
                });
            });
        });
    });

    // Функция для показа alerts
    function showAlert(type, message, callback = null) {
        const alertContainer = document.createElement('div');
        alertContainer.className = `alert alert-${type === 'success' ? 'success' : 'danger'} fixed-top text-center`;
        alertContainer.textContent = message;
        document.body.appendChild(alertContainer);

        setTimeout(() => {
            alertContainer.remove();
            if (callback) callback();
        }, 1500);
    }

    // Функция для показа диалога подтверждения
    function showConfirmDialog(title, message, onConfirm) {
        const confirmDialog = document.createElement('div');
        confirmDialog.innerHTML = `
            <div class="modal" tabindex="-1" style="display:block; background:rgba(0,0,0,0.5);">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">${title}</h5>
                        </div>
                        <div class="modal-body">
                            <p>${message}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary confirm-cancel">Отмена</button>
                            <button type="button" class="btn btn-danger confirm-ok">Да, удалить</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(confirmDialog);

        const cancelButton = confirmDialog.querySelector('.confirm-cancel');
        const okButton = confirmDialog.querySelector('.confirm-ok');

        cancelButton.addEventListener('click', () => {
            document.body.removeChild(confirmDialog);
        });

        okButton.addEventListener('click', () => {
            document.body.removeChild(confirmDialog);
            onConfirm();
        });
    }
});

</script>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
