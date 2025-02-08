<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ShoppingList;

class ShoppingListShared extends Mailable
{
    use Queueable, SerializesModels;

    public $shoppingList;

    public function __construct(ShoppingList $shoppingList)
    {
        $this->shoppingList = $shoppingList;
    }

    public function build()
    {
        return $this->subject('T’han compartit una llista de la compra')
                    ->view('emails.shopping-list-shared');
    }
}
