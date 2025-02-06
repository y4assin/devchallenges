@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div x-data="{ openCreate: false, openEdit: false, editCategory: null }" class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Categories</h1>

        <div class="mb-4 text-right">
            <button @click="openCreate = true" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">
                + Crear Nova Categoria
            </button>
        </div>

        @if($categories->isEmpty())
            <p class="text-center text-gray-600">No hi ha categories disponibles.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @php
                    $colors = [
                        'bg-gradient-to-br from-blue-100 to-blue-200',
                        'bg-gradient-to-br from-green-100 to-green-200',
                        'bg-gradient-to-br from-yellow-100 to-yellow-200',
                        'bg-gradient-to-br from-pink-100 to-pink-200',
                        'bg-gradient-to-br from-purple-100 to-purple-200'
                    ];
                @endphp
                @foreach($categories as $index => $category)
                    <div class="{{ $colors[$index % count($colors)] }} p-4 rounded-lg shadow-md flex flex-col justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $category->name }}</h2>
                        <div class="mt-4 flex justify-between">
                            <button @click="openEdit = true; editCategory = {{ $category }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                Editar
                            </button>
                            <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Modal para crear categoría -->
        <div x-show="openCreate" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">Crear Nova Categoria</h2>
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom de la Categoria</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="openCreate = false" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Crear
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal para editar categoría -->
        <div x-show="openEdit" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">Editar Categoria</h2>
                <form method="POST" :action="'/categories/' + editCategory.id">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="editName" class="block text-sm font-medium text-gray-700">Nom de la Categoria</label>
                        <input type="text" name="name" id="editName" x-model="editCategory.name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
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