<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::paginate(5);
        return view('Inventory.suppliers.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        Supplier::create($request->all());

        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return response()->json($supplier);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Supplier::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
