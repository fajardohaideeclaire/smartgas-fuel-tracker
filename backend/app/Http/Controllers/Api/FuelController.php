<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FuelEntry;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FuelController extends Controller
{
    public function index()
    {
        $entries = FuelEntry::all();
        return Inertia::render('Dashboard', [
            'entries' => $entries
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'station_name' => 'required|string|max:255',
            'fuel_type' => 'required|in:Diesel,Unleaded,Premium',
            'price_per_liter' => 'required|numeric|min:0.01'
        ]);

        FuelEntry::create([
            'user_id' => 1,
            'station_name' => $validated['station_name'],
            'fuel_type' => $validated['fuel_type'],
            'price_per_liter' => $validated['price_per_liter']
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $entry = FuelEntry::findOrFail($id);
        $entry->delete();

        return redirect()->back();
    }
}