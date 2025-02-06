@extends('layouts.app')

@section('content')
    <div x-data="{ openCreate: false, openEdit: false, editProduct: null }" class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Productes Predefinits</h1>

        <div class="mb-4 text-right">
            <button @click="openCreate = true" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">
                + Crear Nou Producte
            </button>
        </div>

        @if($products->isEmpty())
            <p class="text-center text-gray-600">No hi ha productes predefinits disponibles.</p>
        @else
            <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <li class="bg-gradient-to-br from-blue-100 to-blue-200 p-4 rounded-lg shadow-md flex flex-col justify-between">
                        <div class="flex items-center space-x-2">
                            @if($product->icon)
                                <span class="text-2xl">{{ $product->icon }}</span>
                            @endif
                            <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
                        </div>
                        <div class="mt-4 flex justify-between">
                            <button @click="openEdit = true; editProduct = {{ $product }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                Editar
                            </button>
                            <form method="POST" action="{{ route('predefined-products.destroy', $product->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif

        <!-- Modal para Crear -->
        <div x-show="openCreate" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">Crear Producte Predefinit</h2>
                <form action="{{ route('predefined-products.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="createName" class="block text-sm font-medium text-gray-700">Nom:</label>
                        <input type="text" name="name" id="createName" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="createIcon" class="block text-sm font-medium text-gray-700">Icona:</label>
                        <input type="text" name="icon" id="createIcon" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="openCreate = false" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal para Editar -->
        <div x-show="openEdit" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">Editar Producte Predefinit</h2>
                <form id="editForm" method="POST" :action="'/predefined-products/' + editProduct.id">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="editName" class="block text-sm font-medium text-gray-700">Nom:</label>
                        <input type="text" name="name" id="editName" x-model="editProduct.name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="editIcon" class="block text-sm font-medium text-gray-700">Icona:</label>
                        <input type="text" name="icon" id="editIcon" x-model="editProduct.icon" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="openEdit = false" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Actualitzar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection