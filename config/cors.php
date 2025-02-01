<?php

return [
    'paths' => ['api/*'], // Убедитесь, что маршруты API включены
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:5174'], // Укажите точный адрес фронтенда
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false, // Установите true, если используете куки
];


