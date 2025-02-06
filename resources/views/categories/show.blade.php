@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ $category->name }}</h1>

    <ul>
        @foreach($category->products as $product)
            <li class="flex items-center justify-between p-2 bg-gray-100 rounded my-1">
                <span class="{{ $product->completed ? 'line-through text-gray-500' : '' }}">
                    {{ $product->name }}
                </span>
                <form method="POST" action="{{ route('products.toggle', $product->id) }}">
                    @csrf
                    <button class="px-2 py-1 bg-blue-500 text-white rounded">
                        {{ $product->completed ? 'Desmarcar' : 'Marcar' }}
                    </button>
                </form>
            </li>
        @endforeach
    </ul>

    <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline mt-4 inline-block">← Tornar</a>
@endsection
