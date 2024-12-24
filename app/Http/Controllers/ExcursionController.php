<?php

namespace App\Http\Controllers;

use App\Models\Excursion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExcursionController extends Controller
{
    public function index()
    {
        $excursions = Excursion::all();
        return view('excursions.index', compact('excursions'));
    }

    public function create()
    {
        return view('excursions.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer|min:1', // Добавлено поле длительности
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        // Gather all data from the request
        $data = $request->all();

        // Check if a photo was uploaded
        if ($request->hasFile('photo')) {
            // Store the file in the public/uploads directory and get its path
            $path = $request->file('photo')->store('uploads', 'public');
            $data['photo'] = $path; // Store the path in the data array
        }

        // Create a new Excursion record in the database
        Excursion::create($data);

        // Redirect to the excursions index with a success message
        return redirect()->route('excursions.index')->with('success', 'Экскурсия успешно добавлена!');
    }

    public function edit(Excursion $excursion)
    {
        return view('excursions.edit', compact('excursion'));
    }

    public function update(Request $request, Excursion $excursion)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer|min:1', // Добавлено поле длительности
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        // Gather all data from the request, excluding the photo if it wasn't uploaded
        $data = $request->all();

        // Check if a new photo was uploaded
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($excursion->photo) {
                Storage::disk('public')->delete($excursion->photo);
            }
            
            // Store the new file and get its path
            $path = $request->file('photo')->store('uploads', 'public');
            $data['photo'] = $path; // Update the path in the data array
        }

        // Update the excursion record in the database
        $excursion->update($data);

        // Redirect to the excursions index with a success message
        return redirect()->route('excursions.index')->with('success', 'Экскурсия успешно обновлена!');
    }

    public function destroy(Excursion $excursion)
    {
        // Delete the excursion record from the database
        if ($excursion->photo) {
            Storage::disk('public')->delete($excursion->photo); // Delete photo from storage if it exists
        }
        
        $excursion->delete();
        
        return redirect()->route('excursions.index')->with('success', 'Экскурсия успешно удалена!');
    }
}
