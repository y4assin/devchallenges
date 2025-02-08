@extends('layouts.app')

@section('title', 'Les Meves Llistes')

@section('content')
    <div class="container mx-auto px-4 py-8" x-data="{ shareModalOpen: false, listIdToShare: null }">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">🛍️ Les Meves Llistes de Compra</h1>

        @if($shoppingLists->isEmpty() && $sharedLists->isEmpty())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg text-center" role="alert">
                <p class="font-bold">⚠️ Atenció</p>
                <p>No tens cap llista de compra.</p>
            </div>
        @else
            <h2 class="text-2xl font-bold text-gray-900 mb-4">📋 Les Meves Llistes</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                @foreach($shoppingLists as $index => $list)
                    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition duration-300 flex flex-col justify-between">
                        <div class="flex-grow">
                            <a href="{{ route('shopping-lists.show', $list->id) }}" class="block text-lg font-semibold text-gray-900 hover:text-indigo-700 mb-4">
                                <span class="text-2xl text-gray-900 font-bold">📝 {{ $list->name }}</span>
                            </a>
                            <ul class="mb-2 text-sm text-gray-700">
                                @foreach($list->products->take(3) as $product)
                                    <li>✔️ {{ $product->name }}</li>
                                @endforeach
                            </ul>
                            <span class="text-sm text-gray-600">{{ $list->products->count() }} productes</span>
                        </div>
                        <div class="flex justify-between mt-4">
                            <form method="POST" action="{{ route('shopping-lists.destroy', $list->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300">
                                    🗑️ Eliminar
                                </button>
                            </form>
                            <button @click="listIdToShare = {{ $list->id }}; shareModalOpen = true" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                                📤 Compartir
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($sharedLists->isNotEmpty())
                <h2 class="text-2xl font-bold text-gray-900 mb-4">📌 Llistes Compartides amb Mi</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                    @foreach($sharedLists as $list)
                        <div class="bg-gray-100 p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 flex flex-col justify-between">
                            <div class="flex-grow">
                                <a href="{{ route('shopping-lists.show', $list->id) }}" class="block text-lg font-semibold text-gray-900 hover:text-indigo-700 mb-4">
                                    <span class="text-2xl text-gray-900 font-bold">📜 {{ $list->name }}</span>
                                </a>
                                <ul class="mb-2 text-sm text-gray-700">
                                    @foreach($list->products->take(3) as $product)
                                        <li>✔️ {{ $product->name }}</li>
                                    @endforeach
                                </ul>
                                <span class="text-sm text-gray-600">{{ $list->products->count() }} productes</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="text-center">
            <a href="{{ route('shopping-lists.create') }}" class="inline-block bg-green-600 text-white px-6 py-3 rounded-full shadow-lg hover:bg-green-700 transition duration-300">
                ➕ Crear Nova Llista
            </a>
        </div>

        <!-- Modal per compartir la llista -->
        <div x-show="shareModalOpen" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">📤 Compartir Llista</h2>
                <form method="POST" :action="`/shopping-lists/${listIdToShare}/share`">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">📧 Correu Electrònic</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Introdueix el correu electrònic">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="shareModalOpen = false" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-gray-600 transition duration-300">
                            ❌ Cancelar
                        </button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                            📤 Compartir
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
