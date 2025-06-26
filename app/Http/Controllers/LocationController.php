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

        return back()->with('success', 'Konum başarıyla eklendi!');
    }


    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:locations,id',
            'name' => 'required|string|max:100',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        $location = Location::findOrFail($validated['id']);
        $location->update($validated);

        return back()->with('success', 'Konum güncellendi!');
    }

}
