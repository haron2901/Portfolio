<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

    public function create(Request $request)
    {
        $inventory = new Inventory;
        $inventory->name = $request->name;
        $inventory->price_for_day = $request->price_for_day;
        $inventory->price_for_week = $request->price_for_week;

        $inventory->save();

        return response()->json(['message' => 'Inventory created successfully'], 201);
    }


    public function delete(Request $request)
    {
        $data =$request->toArray();
        $inventory = Inventory::findOrFail($data['id']);
        $inventory->delete();

        return response()->json(['message' => 'Inventory deleted successfully'], 200);
    }

    public function update(Request $request)
    {
        $data = $request->toArray();
        $inventory = Inventory::findOrFail($data['id']);
        $inventory->name = $request->name ?? $inventory->name;
        $inventory->price_for_day = $request->price_for_day ?? $inventory->price_for_day;
        $inventory->price_for_week = $request->price_for_week ?? $inventory->price_for_week;

        $inventory->save();

        return response()->json(['message' => 'Inventory updated successfully'], 200);
    }

    public function getAllFree()
    {
        $Inventories = Inventory::where('status', 'Свободен')->get();

        return view('Rent', ['Inventories' => $Inventories]);

    }

}
