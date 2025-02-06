<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;

class ShoppingListController extends Controller
{
    public function index()
    {
        $shoppingLists = auth()->user()->shoppingLists()->with('products')->get();
        $sharedLists = auth()->user()->sharedShoppingLists()->with('products')->get();
    
        return view('shopping-lists.index', compact('shoppingLists', 'sharedLists'));
    }

    public function show($id)
    {
        $shoppingList = ShoppingList::with('products')->findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('shopping-lists.show', compact('shoppingList', 'categories', 'tags'));
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
        'new_products' => 'array',
        'new_products.*' => 'string|max:255',
        'categories' => 'array',
        'categories.*' => 'nullable|exists:categories,id',
    ]);

    $shoppingList = new ShoppingList();
    $shoppingList->name = $request->input('name');
    $shoppingList->user_id = auth()->id();
    $shoppingList->save();

    $newProducts = $request->input('new_products', []);
    $categories = $request->input('categories', []);

    foreach ($newProducts as $index => $productName) {
        if (!empty($productName)) {
            $product = new Product();
            $product->name = $productName;
            $product->shopping_list_id = $shoppingList->id;
            $product->category_id = $categories[$index] ?? null; // Usa null si no hay categoría
            $product->save();
        }
    }

    return redirect()->route('shopping-lists.index')->with('success', 'Llista de compra creada amb èxit.');
}

    public function destroy($id)
    {
        $shoppingList = ShoppingList::findOrFail($id);

        // Eliminar todos los productos asociados a la lista
        $shoppingList->products()->delete();

        // Eliminar la lista de compras
        $shoppingList->delete();

        return redirect()->route('shopping-lists.index')
                         ->with('success', 'Llista de compra eliminada amb èxit.');
    }

    public function share(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
    
        $user = User::where('email', $request->input('email'))->first();
        $shoppingList = ShoppingList::findOrFail($id);
    
        // Verifica si la lista ya está compartida con el usuario
        if (!$shoppingList->sharedUsers->contains($user->id)) {
            // Compartir la lista con el usuario
            $shoppingList->sharedUsers()->attach($user->id);
        }
    
        return redirect()->route('shopping-lists.index')
                         ->with('success', 'Llista compartida amb èxit.');
    }

}