<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShoppingListController extends Controller
{
    public function index()
    {
        $shoppingLists = auth()->user()->shoppingLists()->with('products')->get();
        return view('shopping-lists.index', compact('shoppingLists'));
    }

    public function show($id)
    {
        $shoppingList = ShoppingList::with('products')->findOrFail($id);
        $categories = Category::all();
        return view('shopping-lists.show', compact('shoppingList', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('shopping-lists.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'products' => 'array',
            'products.*' => 'string|max:255',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);
    
        $shoppingList = new ShoppingList();
        $shoppingList->name = $request->input('name');
        $shoppingList->user_id = auth()->id();
        $shoppingList->save();
    
        foreach ($request->input('products', []) as $index => $productName) {
            $product = new Product();
            $product->name = $productName;
            $product->shopping_list_id = $shoppingList->id;
            $product->category_id = $request->input('categories')[$index]; // Asegúrate de que siempre haya un valor
            $product->save();
        }
    
        return redirect()->route('shopping-lists.index')->with('success', 'Llista de compra creada amb èxit.');
    }
}