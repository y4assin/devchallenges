@extends('layouts.app')

@section('title', $shoppingList->name)

@section('content')
    <div class="container mx-auto px-4 py-8" x-data="{ open: false, product: null }">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-6">{{ $shoppingList->name }}</h1>

        <div class="mb-4 flex justify-between">
            <a href="{{ route('shopping-lists.index') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-full shadow hover:bg-indigo-700 transition duration-300">
                ← Tornar a les Llistes
            </a>
            <button @click="open = true" class="bg-teal-500 text-white px-4 py-2 rounded-full shadow hover:bg-teal-600 transition duration-300">
                + Afegir Producte
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($shoppingList->products as $product)
                <div class="bg-gray-100 p-4 rounded-lg shadow-md flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
                        <p class="text-sm text-gray-600">Categoria: {{ $product->category->name ?? 'Sense Categoria' }}</p>
                    </div>
                    <div class="mt-4 flex justify-between">
                        <button @click="open = true; product = {{ $product }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition duration-300">
                            Editar
                        </button>
                        <form method="POST" action="{{ route('products.destroy', $product->id) }}" @submit.prevent="if(confirm('¿Estás seguro de que deseas eliminar este producto?')) $event.target.submit()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition duration-300">
                                Eliminar
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