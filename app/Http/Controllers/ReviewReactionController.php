<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\ReviewReaction;
use Illuminate\Support\Facades\Auth;

class ReviewReactionController extends Controller
{
    public function react(Request $request, Review $review)
    {
        $validated = $request->validate([
            'emoji' => 'required|in:👍,👎,❤️,😂,😱'
        ]);

        $existingReaction = ReviewReaction::where([
            'review_id' => $review->id,
            'user_id' => Auth::id()
        ])->first();

        if ($existingReaction) {
            // Обновление существующей реакции
            $existingReaction->update($validated);
        } else {
            // Создание новой реакции
            ReviewReaction::create([
                'review_id' => $review->id,
                'user_id' => Auth::id(),
                'emoji' => $validated['emoji']
            ]);
        }

        return back()->with('success', 'Реакция сохранена');
    }
}
