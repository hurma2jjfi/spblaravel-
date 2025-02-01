<?php

namespace App\Http\Controllers;

use App\Models\Excursion; // Import the Excursion model
use Illuminate\Http\Request;

class ExcursionInfoController extends Controller
{
    public function index()
    {
        $excursions = Excursion::all(); 
        return view('user.dashboard', compact('excursions')); 
    }
}


