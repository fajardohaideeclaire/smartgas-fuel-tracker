<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FuelEntry;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    public function index()
    {
        return response()->json(FuelEntry::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'station_name' => 'required|string|max:255',
            'fuel_type' => 'required|in:Diesel,Unleaded,Premium',
            'price_per_liter' => 'required|numeric|min:0.01'
        ]);

        $entry = FuelEntry::create([
            'user_id' => 1,
            'station_name' => $validated['station_name'],
            'fuel_type' => $validated['fuel_type'],
            'price_per_liter' => $validated['price_per_liter']
        ]);

        return response()->json([
            'message' => 'Fuel entry added successfully',
            'data' => $entry
        ], 201);
    }

    public function destroy($id)
    {
        $entry = FuelEntry::findOrFail($id);
        $entry->delete();

        return response()->json([
            'message' => 'Fuel entry deleted successfully'
        ]);
    }
}