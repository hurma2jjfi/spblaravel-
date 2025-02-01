<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Excursion extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'photo', 'duration'];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function reactions()
    {
        return $this->hasMany(ReviewReaction::class);
    }

    public function getEmojiCounts()
    {
        return $this->reactions()
            ->select('emoji', DB::raw('COUNT(*) as count'))
            ->groupBy('emoji')
            ->pluck('count', 'emoji');
    }
}


