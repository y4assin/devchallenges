@extends('layouts.app')

@section('title', 'Poker Game')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-6">Poker Game</h1>
        <div id="game" class="text-center">
            <!-- Aquí se mostrarán las cartas y el resultado -->
            <button id="play-game" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Jugar
            </button>
            <div id="result" class="mt-4"></div>
        </div>
    </div>

    <script>
document.getElementById('play-game').addEventListener('click', function() {
    const player1CardIndex = Math.floor(Math.random() * 5);
    const player2CardIndex = Math.floor(Math.random() * 5);

    fetch('{{ route('game.play') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            player1_card: player1CardIndex,
            player2_card: player2CardIndex
        })
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('result').innerText = data;
    });
});document.getElementById('play-game').addEventListener('click', function() {
    const player1CardIndex = Math.floor(Math.random() * 5);
    const player2CardIndex = Math.floor(Math.random() * 5);

    fetch('{{ route('game.play') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            player1_card: player1CardIndex,
            player2_card: player2CardIndex
        })
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('result').innerText = data;
    });
});
    </script>
@endsection