<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{

    /**
     * Display a listing of the cars.
     */
    public function index()
    {
        $cars = Car::with('parts')->get();
        return response()->json($cars);
    }

    /**
     * Store a newly created car in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'nullable|string|required_if:is_registered,true',
            'is_registered' => 'required|boolean',
        ]);

        $car = Car::create($validated);
        return response()->json($car, 201);
    }

    /**
     * Display the specified car.
     */
    public function show(Car $car)
    {
        return response()->json($car->load('parts'));
    }

    /**
     * Update the specified car in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'nullable|string|required_if:is_registered,true',
            'is_registered' => 'required|boolean',
        ]);

        $car->update($validated);
        return response()->json($car);
    }

    /**
     * Remove the specified car from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return response()->json(['message' => 'Car deleted successfully']);
    }
}
