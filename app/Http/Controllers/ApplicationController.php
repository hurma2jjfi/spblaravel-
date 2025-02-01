<?php


namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        
        $applications = Application::where('user_id', Auth::id())->with('excursion')->get();
        
        return view('applications.index', compact('applications'));
    }

    public function cancel($id)
{
    $application = Application::findOrFail($id);
    
    // Убедитесь, что пользователь может отменить только свои заявки
    if ($application->user_id !== Auth::id()) {
        return redirect()->back()->withErrors(['message' => 'Вы не можете отменить эту заявку.']);
    }

    $application->delete();

    return redirect()->route('applications.index')->with('success', 'Заявка успешно отменена.');
}


public function updateStatus(Request $request, $id)
{
    try {
        $application = Application::findOrFail($id);
        
        $validatedData = $request->validate([
            'status' => 'required|in:В ожидании,Одобрено,Отклонено'
        ]);

        $application->update([
            'status' => $validatedData['status']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Статус успешно обновлен',
            'status' => $application->status
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Ошибка обновления статуса: ' . $e->getMessage()
        ], 500);
    }
}

public function destroy($id)
{
    try {
        $application = Application::findOrFail($id);
        $application->delete();
        
        return response()->json([
            'success' => true, 
            'message' => 'Заявка удалена'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false, 
            'message' => 'Ошибка удаления'
        ], 500);
    }
}






}
