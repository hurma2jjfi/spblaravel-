<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\ReviewReaction;
use Illuminate\Support\Facades\Auth;

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
            'emoji' => 'required|in:👍,❤️,😮,😂,😢'
        ]);

      
        $existingReaction = ReviewReaction::where([
            'excursion_id' => $review->id,
            'user_id' => Auth::id()
        ])->first();

        if ($existingReaction) {
 
  
            if ($existingReaction->emoji === $validated['emoji']) {
                $existingReaction->delete();
                return back()->with('success', 'Реакция удалена');
            } else {
               
                $existingReaction->delete();
                
        
                ReviewReaction::create([
                    'excursion_id' => $review->id,
                    'user_id' => Auth::id(),
                    'emoji' => $validated['emoji']
                ]);
                
                return back()->with('success', 'Реакция обновлена');
            }
        } else {
       
            
            ReviewReaction::create([
                'excursion_id' => $review->id,
                'user_id' => Auth::id(),
                'emoji' => $validated['emoji']
            ]);
            
            return back()->with('success', 'Реакция сохранена');
        }
    }
}
