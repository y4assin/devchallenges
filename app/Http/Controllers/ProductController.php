<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function toggleCompleted($id)
    {
        $product = Product::findOrFail($id);
        $product->completed = !$product->completed;
        $product->save();

        return back();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'shopping_list_id' => 'required|exists:shopping_lists,id',
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->shopping_list_id = $request->input('shopping_list_id');
        $product->save();

        return redirect()->route('shopping-lists.show', $product->shopping_list_id)
                         ->with('success', 'Producte afegit amb èxit.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->save();

        return redirect()->route('shopping-lists.show', $product->shopping_list_id)
                         ->with('success', 'Producte actualitzat amb èxit.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('shopping-lists.show', $product->shopping_list_id)
                         ->with('success', 'Producte eliminat amb èxit.');
    }
}

