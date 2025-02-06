<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;
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
            'category_id' => 'required|exists:categories,id',
            'shopping_list_id' => 'required|exists:shopping_lists,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'new_tags' => 'nullable|string',
        ]);
    
        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->shopping_list_id = $request->input('shopping_list_id');
        $product->save();
    
        // Asignar tags existentes
        $product->tags()->attach($request->input('tags', []));
    
        // Crear y asignar nuevos tags
        if ($request->filled('new_tags')) {
            $newTags = explode(',', $request->input('new_tags'));
            foreach ($newTags as $newTagName) {
                $newTagName = trim($newTagName);
                if (!empty($newTagName)) {
                    $tag = Tag::firstOrCreate(['name' => $newTagName]);
                    $product->tags()->attach($tag->id);
                }
            }
        }
    
        return redirect()->route('shopping-lists.show', $product->shopping_list_id)
                         ->with('success', 'Producte afegit amb èxit.');
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

}