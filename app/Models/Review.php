<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
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
