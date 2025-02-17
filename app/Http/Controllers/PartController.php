<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Display a listing of the parts.
     */
    public function index()
    {
        $parts = Part::with('car')->get();
        return response()->json($parts);
    }

    /**
     * Store a newly created part in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'serialnumber' => 'required|string|max:255',
            'car_id' => 'required|exists:cars,id',
        ]);

        $part = Part::create($validated);
        return response()->json($part, 201);
    }

    /**
     * Display the specified part.
     */
    public function show(Part $part)
    {
        return response()->json($part->load('car'));
    }

    /**
     * Update the specified part in storage.
     */
    public function update(Request $request, Part $part)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'serialnumber' => 'required|string|max:255',
            'car_id' => 'required|exists:cars,id',
        ]);

        $part->update($validated);
        return response()->json($part);
    }

    /**
     * Remove the specified part from storage.
     */
    public function destroy(Part $part)
    {
        $part->delete();
        return response()->json(['message' => 'Part deleted successfully']);
    }
}
