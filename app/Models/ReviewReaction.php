<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ReviewReaction extends Model
{
    protected $fillable = ['excursion_id', 'user_id', 'emoji'];

    public function excursion()
    {
        return $this->belongsTo(Excursion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

