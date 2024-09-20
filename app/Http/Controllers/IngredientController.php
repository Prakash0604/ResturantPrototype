<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::all();
        return view('Inventory.ingredients.index', compact('ingredients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric',
            'unit' => 'required',
        ]);

        Ingredient::create($request->all());

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Ingredient::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
