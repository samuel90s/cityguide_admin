<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    public function index()
    {
        $accommodations = Accommodation::all();
        return view('accommodations.index', compact('accommodations'));
    }

    public function create()
    {
        return view('accommodations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'price_per_night' => 'nullable|numeric',
            'facilities' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('accommodations', 'public');
            $imageUrl = asset('storage/' . $path);
        }

        Accommodation::create([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'price_per_night' => $request->price_per_night,
            'facilities' => $request->facilities,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('accommodations.index')->with('success', 'Accommodation created successfully.');
    }

    public function edit(Accommodation $accommodation)
    {
        return view('accommodations.edit', compact('accommodation'));
    }

    public function update(Request $request, Accommodation $accommodation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'price_per_night' => 'nullable|numeric',
            'facilities' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageUrl = $accommodation->image_url;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('accommodations', 'public');
            $imageUrl = asset('storage/' . $path);
        }

        $accommodation->update([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'price_per_night' => $request->price_per_night,
            'facilities' => $request->facilities,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('accommodations.index')->with('success', 'Accommodation updated successfully.');
    }

    public function destroy(Accommodation $accommodation)
    {
        $accommodation->delete();

        return redirect()->route('accommodations.index')->with('success', 'Accommodation deleted successfully.');
    }
}
