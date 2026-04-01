<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FuelEntry;

class FuelController extends Controller
{
   public function index()
   {
       return FuelEntry::where('user_id', 1)->latest()->get();
   }

   public function store(Request $request)
   {
       $request->validate([
           'station_name' => 'required',
           'fuel_type' => 'required',
           'price_per_liter' => 'required|numeric|min:0.01'
       ]);

       return FuelEntry::create([
           'user_id' => 1,
           'station_name' => $request->station_name,
           'fuel_type' => $request->fuel_type,
           'price_per_liter' => $request->price_per_liter
       ]);
   }

   public function destroy($id)
   {
       FuelEntry::findOrFail($id)->delete();
       return response()->json(['message' => 'deleted']);
   }
}
