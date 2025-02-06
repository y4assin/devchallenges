<?php

namespace App\Http\Controllers;

use App\Models\PredefinedProduct;
use Illuminate\Http\Request;

class PredefinedProductController extends Controller
{
    public function index()
    {
        $products = PredefinedProduct::all();
        return view('predefined-products.index', compact('products'));
    }

    public function create()
    {
        return view('predefined-products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        PredefinedProduct::create($request->all());

        return redirect()->route('predefined-products.index')
                         ->with('success', 'Producte predefinit creat amb èxit.');
    }

    public function edit(PredefinedProduct $predefinedProduct)
    {
        return view('predefined-products.edit', compact('predefinedProduct'));
    }

    public function update(Request $request, PredefinedProduct $predefinedProduct)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        $predefinedProduct->update($request->all());

        return redirect()->route('predefined-products.index')
                         ->with('success', 'Producte predefinit actualitzat amb èxit.');
    }

    public function destroy(PredefinedProduct $predefinedProduct)
    {
        $predefinedProduct->delete();

        return redirect()->route('predefined-products.index')
                         ->with('success', 'Producte predefinit eliminat amb èxit.');
    }
}