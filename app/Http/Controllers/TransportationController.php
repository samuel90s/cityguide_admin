<?php

namespace App\Http\Controllers;

use App\Models\Transportation;
use Illuminate\Http\Request;

class TransportationController extends Controller
{
    public function index()
    {
        $transportations = Transportation::all();
        return view('transportations.index', compact('transportations'));
    }

    public function create()
    {
        return view('transportations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:bus,car_rental,train,boat,plane',
            'description' => 'nullable|string',
            'price_range' => 'nullable|string|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('transportations', 'public');
            $imageUrl = asset('storage/' . $path);
        }

        Transportation::create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'price_range' => $request->price_range,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('transportations.index')->with('success', 'Transportation created successfully.');
    }

    public function show(Transportation $transportation)
    {
        return view('transportations.show', compact('transportation'));
    }

    public function edit(Transportation $transportation)
    {
        return view('transportations.edit', compact('transportation'));
    }

    public function update(Request $request, Transportation $transportation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:bus,car_rental,train,boat,plane',
            'description' => 'nullable|string',
            'price_range' => 'nullable|string|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageUrl = $transportation->image_url;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('transportations', 'public');
            $imageUrl = asset('storage/' . $path);
        }

        $transportation->update([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'price_range' => $request->price_range,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('transportations.index')->with('success', 'Transportation updated successfully.');
    }

    public function destroy(Transportation $transportation)
    {
        $transportation->delete();

        return redirect()->route('transportations.index')->with('success', 'Transportation deleted successfully.');
    }
}
