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
            'image' => 'nullable|string',
        ]);

        Transportation::create($request->all());

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
            'image' => 'nullable|string',
        ]);

        $transportation->update($request->all());

        return redirect()->route('transportations.index')->with('success', 'Transportation updated successfully.');
    }

    public function destroy(Transportation $transportation)
    {
        $transportation->delete();

        return redirect()->route('transportations.index')->with('success', 'Transportation deleted successfully.');
    }
}
