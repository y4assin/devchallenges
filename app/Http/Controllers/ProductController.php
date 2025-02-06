<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
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
            'new_tags' => 'nullable|string',
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->shopping_list_id = $request->input('shopping_list_id');
        $product->save();

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

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'new_tags' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->save();

        // Sincronizar y crear nuevos tags
        $tags = [];
        if ($request->filled('new_tags')) {
            $newTags = explode(',', $request->input('new_tags'));
            foreach ($newTags as $newTagName) {
                $newTagName = trim($newTagName);
                if (!empty($newTagName)) {
                    $tag = Tag::firstOrCreate(['name' => $newTagName]);
                    $tags[] = $tag->id;
                }
            }
        }
        $product->tags()->sync($tags);

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