<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Models\PurchaseDetail;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('details')->get();
        $suppliers = Supplier::all();
        $ingredients = Ingredient::all();

        return view('Inventory.purchases.index', compact('purchases', 'suppliers', 'ingredients'));
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
            'total_price' => 'required|numeric',
            'ingredients' => 'required|array',
            'quantity' => 'required|array',
            'price' => 'required|array',
        ]);

        DB::transaction(function () use ($request) {
            $purchase = Purchase::create([
                'supplier_id' => $request->supplier_id,
                'purchase_date' => $request->purchase_date,
                'total_price' => $request->total_price,
            ]);

            foreach ($request->ingredients as $key => $ingredient_id) {
                PurchaseDetail::create([
                    'purchase_id' => $purchase->id,
                    'ingredient_id' => $ingredient_id,
                    'quantity' => $request->quantity[$key],
                    'price' => $request->price[$key],
                ]);
            }
        });

        return response()->json(['success' => true, 'message' => 'Purchase created successfully.']);
    }

    public function edit($id)
    {
        $purchase = Purchase::with('details')->findOrFail($id);
        $suppliers = Supplier::all();
        $ingredients = Ingredient::all();

        return response()->json(compact('purchase', 'suppliers', 'ingredients'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
            'total_price' => 'required|numeric',
            'ingredients' => 'required|array',
            'quantity' => 'required|array',
            'price' => 'required|array',
        ]);

        DB::transaction(function () use ($request, $id) {
            $purchase = Purchase::findOrFail($id);
            $purchase->update([
                'supplier_id' => $request->supplier_id,
                'purchase_date' => $request->purchase_date,
                'total_price' => $request->total_price,
            ]);

            // Clear existing purchase details
            $purchase->details()->delete();

            // Insert updated purchase details
            foreach ($request->ingredients as $key => $ingredient_id) {
                PurchaseDetail::create([
                    'purchase_id' => $purchase->id,
                    'ingredient_id' => $ingredient_id,
                    'quantity' => $request->quantity[$key],
                    'price' => $request->price[$key],
                ]);
            }
        });

        return response()->json(['success' => true, 'message' => 'Purchase updated successfully.']);
    }

    public function show($id)
    {
        $purchase = Purchase::with('details.ingredient', 'supplier')->findOrFail($id);
        return response()->json($purchase);
    }

    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();

        return response()->json(['success' => true, 'message' => 'Purchase deleted successfully.']);
    }
}
