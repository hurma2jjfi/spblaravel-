<?php

namespace App\Http\Controllers;

use App\Models\Excursion;
use Illuminate\Http\Request;

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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        Excursion::create($request->all());
        return redirect()->route('excursions.index')->with('success', 'Экскурсия успешно добавлена!');
    }

    public function edit(Excursion $excursion)
    {
        return view('excursions.edit', compact('excursion'));
    }

    public function update(Request $request, Excursion $excursion)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $excursion->update($request->all());
        return redirect()->route('excursions.index')->with('success', 'Экскурсия успешно обновлена!');
    }

    public function destroy(Excursion $excursion)
    {
        $excursion->delete();
        return redirect()->route('excursions.index')->with('success', 'Экскурсия успешно удалена!');
    }
}

