@extends('layouts.app')

@section('title', 'Crear Nova Llista')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Crear Nova Llista</h1>

        <form method="POST" action="{{ route('shopping-lists.store') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom de la Llista</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <h2 class="text-lg font-semibold mb-2">Productes</h2>
                <div id="product-list" class="space-y-2">
                    <!-- Aquí se añadirán los productos -->
                </div>
                <button type="button" id="add-product" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Afegir Producte
                </button>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Crear Llista
            </button>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const addProductButton = document.getElementById('add-product');
        addProductButton.addEventListener('click', function() {
            const productList = document.getElementById('product-list');
            const productDiv = document.createElement('div');
            productDiv.classList.add('flex', 'items-center', 'space-x-2');

            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'products[]';
            input.placeholder = 'Nom del producte';
            input.classList.add('mt-1', 'block', 'w-full', 'border-gray-300', 'rounded-md', 'shadow-sm');

            const select = document.createElement('select');
            select.name = 'categories[]';
            select.classList.add('mt-1', 'block', 'w-full', 'border-gray-300', 'rounded-md', 'shadow-sm');
            let option = document.createElement('option');
            option.value = '';
            option.textContent = 'Selecciona una categoria';
            select.appendChild(option);
            @foreach($categories as $category)
                option = document.createElement('option');
                option.value = '{{ $category->id }}';
                option.textContent = '{{ $category->name }}';
                select.appendChild(option);
            @endforeach

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.textContent = 'Eliminar';
            removeButton.classList.add('bg-red-500', 'text-white', 'px-2', 'py-1', 'rounded', 'hover:bg-red-600');
            removeButton.addEventListener('click', function() {
                productList.removeChild(productDiv);
            });

            productDiv.appendChild(input);
            productDiv.appendChild(select);
            productDiv.appendChild(removeButton);
            productList.appendChild(productDiv);
        });
    });
</script>
@endsection