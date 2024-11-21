<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IngredientController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $ingredients = Ingredient::orderBy('id','desc')->get();
            return DataTables::of($ingredients)
            ->addIndexColumn()
            ->addColumn('action', function ($item) {
                // $btn = '<button type="button" class="btn btn-primary mr-2 editEmployee" data-id="' . $item->id . '" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>';
                return  '<button type="button" class="btn btn-danger deleteIngrediance" data-id="' . $item->id . '" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);

        }
        return view('Inventory.ingredients.index');
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
