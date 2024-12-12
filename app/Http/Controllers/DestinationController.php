<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::all();
        return view('destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('destinations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'category' => 'required|in:natural,cultural,recreational,culinary',
            'price_range' => 'nullable|string|max:100',
            'opening_hours' => 'nullable|string|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('destinations', 'public');
            $imageUrl = asset('storage/' . $path);
        }

        Destination::create([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'category' => $request->category,
            'price_range' => $request->price_range,
            'opening_hours' => $request->opening_hours,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('destinations.index');
    }

    public function show(Destination $destination)
    {
        return view('destinations.show', compact('destination'));
    }

    public function edit(Destination $destination)
    {
        return view('destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'category' => 'required|in:natural,cultural,recreational,culinary',
            'price_range' => 'nullable|string|max:100',
            'opening_hours' => 'nullable|string|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageUrl = $destination->image_url;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('destinations', 'public');
            $imageUrl = asset('storage/' . $path);
        }

        $destination->update([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'category' => $request->category,
            'price_range' => $request->price_range,
            'opening_hours' => $request->opening_hours,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('destinations.index');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();

        return redirect()->route('destinations.index');
    }
}
