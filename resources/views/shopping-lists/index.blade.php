@extends('layouts.app')

@section('title', 'Les Meves Llistes')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Les Meves Llistes de Compra</h1>

        @if($shoppingLists->isEmpty())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
                <p class="font-bold">Atenció</p>
                <p>No tens cap llista de compra.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                @php
                    $colors = [
                        'bg-gradient-to-br from-blue-100 to-blue-200',
                        'bg-gradient-to-br from-green-100 to-green-200',
                        'bg-gradient-to-br from-yellow-100 to-yellow-200',
                        'bg-gradient-to-br from-pink-100 to-pink-200',
                        'bg-gradient-to-br from-purple-100 to-purple-200'
                    ];
                @endphp
                @foreach($shoppingLists as $index => $list)
                    <div class="{{ $colors[$index % count($colors)] }} p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 h-48 flex flex-col justify-between">
                        <a href="{{ route('shopping-lists.show', $list->id) }}" class="flex flex-col items-start text-lg font-semibold text-gray-800 hover:text-gray-900">
                            <span class="mb-2 text-2xl text-gray-900">{{ $list->name }}</span>
                            <ul class="mb-2 text-sm text-gray-700">
                                @foreach($list->products->take(3) as $product)
                                    <li>- {{ $product->name }}</li>
                                @endforeach
                            </ul>
                            <span class="text-sm text-gray-900">{{ $list->products->count() }} productes</span>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="text-center">
            <a href="{{ route('shopping-lists.create') }}" class="inline-block bg-green-600 text-white px-6 py-3 rounded-full shadow-lg hover:bg-green-700 transition duration-300">
                + Crear Nova Llista
            </a>
        </div>
    </div>
@endsection