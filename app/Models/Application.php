<?php

// app/Models/Application.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'excursion_id',
        'status',
    ];


    public function setStatusAttribute($value)
{
    $statusMap = [
        'pending' => 'В ожидании',
        'approved' => 'Одобрено', 
        'rejected' => 'Отклонено'
    ];

    $this->attributes['status'] = $statusMap[$value] ?? $value;
}

    

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Связь с экскурсией
    public function excursion()
    {
        return $this->belongsTo(Excursion::class);
    }
}
