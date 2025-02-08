<h1>T’han compartit una llista de la compra</h1>
<p>{{ $shoppingList->name }}</p>
<p>Pots accedir-hi al següent enllaç:</p>
<a href="{{ route('shopping-lists.show', $shoppingList->id) }}">Veure la llista</a>
