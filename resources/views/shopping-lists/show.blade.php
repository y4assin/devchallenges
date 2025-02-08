@extends('layouts.app')

@section('title', $shoppingList->name)

@section('content')
    <div class="container mx-auto px-4 py-8" x-data="{ open: false, product: null }">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-6 text-center">🛒 {{ $shoppingList->name }}</h1>

        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('shopping-lists.index') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-full shadow-lg hover:bg-indigo-700 transition duration-300">
                ← Tornar a les Llistes
            </a>
            <button @click="open = true; product = null" class="bg-teal-500 text-white px-6 py-3 rounded-full shadow-lg hover:bg-teal-600 transition duration-300">
                + Afegir Producte
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($shoppingList->products as $product)
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition duration-300 flex flex-col justify-between">
                    <div class="flex items-center space-x-4">
                        <input type="checkbox" class="form-checkbox h-6 w-6 text-green-500" @click="toggleProduct({{ $product->id }})" :checked="{{ $product->completed ? 'true' : 'false' }}">
                        <h2 :class="{ 'line-through text-gray-500': {{ $product->completed ? 'true' : 'false' }} }" class="text-xl font-semibold text-gray-900">{{ $product->name }}</h2>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">📁 Categoria: <span class="font-semibold">{{ $product->category->name ?? 'Sense Categoria' }}</span></p>
                    @if($product->tags->isNotEmpty())
                        <p class="text-sm text-gray-600 mt-1">🏷️ Tags: 
                            @foreach($product->tags as $tag)
                                <span class="inline-block bg-gray-200 text-gray-800 px-3 py-1 rounded-full text-xs font-medium">{{ $tag->name }}</span>
                            @endforeach
                        </p>
                    @endif
                    <div class="mt-6 flex justify-between">
                        <button @click="open = true; product = {{ $product }}" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition duration-300">
                            ✏️ Editar
                        </button>
                        <form method="POST" action="{{ route('products.destroy', $product->id) }}" @submit.prevent="if(confirm('¿Estás seguro de que deseas eliminar este producto?')) $event.target.submit()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-300">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal para añadir o editar productos -->
        <div x-show="open" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-xl font-bold mb-4" x-text="product ? 'Editar Producte' : 'Afegir Producte'"></h2>
                <form method="POST" :action="product ? '/products/' + product.id : '{{ route('products.store') }}'">
                    @csrf
                    <template x-if="product">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    <input type="hidden" name="shopping_list_id" value="{{ $shoppingList->id }}">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom del Producte</label>
                        <input type="text" name="name" id="name" x-model="product ? product.name : ''" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-700">Categoria</label>
                        <select name="category_id" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($categories as $category)
                                <option :selected="product && product.category_id == {{ $category->id }}" value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="new_tags" class="block text-sm font-medium text-gray-700">Tags (separats per comes)</label>
                        <input type="text" name="new_tags" id="new_tags" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="open = false" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600 transition duration-300">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
                            Guardar Canvis
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
