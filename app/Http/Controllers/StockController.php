<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('ingredient')->get();
        $ingredients = Ingredient::all();
        return view('Inventory.stocks.index', compact('stocks', 'ingredients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity' => 'required|numeric',
            'unit' => 'required|string'
        ]);

        Stock::create([
            'ingredient_id' => $request->ingredient_id,
            'quantity' => $request->quantity,
            'unit' => $request->unit
        ]);

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity' => 'required|numeric',
            'unit' => 'required|string'
        ]);

        $stock = Stock::findOrFail($id);
        $stock->update([
            'ingredient_id' => $request->ingredient_id,
            'quantity' => $request->quantity,
            'unit' => $request->unit
        ]);

        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $stock = Stock::findOrFail($id);
        return response()->json($stock);
    }


    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return response()->json(['success' => true]);
    }
}
