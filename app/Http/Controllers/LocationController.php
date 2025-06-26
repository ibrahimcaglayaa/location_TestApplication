<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        Location::create($validated);

        return response()->json(['message' => 'Konum başarıyla eklendi']);
    }
}
