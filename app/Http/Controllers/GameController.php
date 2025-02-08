<?php

// app/Http/Controllers/GameController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    protected $deck;
    protected $players;

    public function __construct()
    {
        $this->deck = $this->createDeck();
        shuffle($this->deck);
        $this->players = [
            'player1' => array_splice($this->deck, 0, 5),
            'player2' => array_splice($this->deck, 0, 5),
        ];
    }

    public function index()
    {
        return view('game.index', [
            'player1Cards' => $this->players['player1'],
            'player2Cards' => $this->players['player2'],
        ]);
    }

    public function createDeck()
    {
        $suits = ['hearts', 'diamonds', 'clubs', 'spades'];
        $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
        $deck = [];

        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $deck[] = ['suit' => $suit, 'value' => $value];
            }
        }

        return $deck;
    }

    public function play(Request $request)
    {
        $players = session('players');
        $player1CardIndex = $request->input('player1_card');
        $player2CardIndex = $request->input('player2_card');
    
        // Verificar que los índices sean válidos
        if (!isset($players['player1'][$player1CardIndex]) || !isset($players['player2'][$player2CardIndex])) {
            return response()->json('Invalid card selection', 400);
        }
    
        $player1Card = $players['player1'][$player1CardIndex];
        $player2Card = $players['player2'][$player2CardIndex];
    
        $result = $this->determineWinner($player1Card, $player2Card);
    
        return response()->json($result);
    }

    public function determineWinner($card1, $card2)
    {
        $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
        $value1 = array_search($card1['value'], $values);
        $value2 = array_search($card2['value'], $values);

        if ($value1 > $value2) {
            return 'Player 1 wins!';
        } elseif ($value1 < $value2) {
            return 'Player 2 wins!';
        } else {
            return 'It\'s a tie!';
        }
    }
}