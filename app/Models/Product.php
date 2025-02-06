<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'completed', 'category_id', 'shopping_list_id'];

    protected $casts = [
        'completed' => 'boolean',
    ];

    // Relació amb la llista de la compra
    public function shoppingList(): BelongsTo
    {
        return $this->belongsTo(ShoppingList::class);
    }

    // Relació amb la categoria
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Relació amb etiquetes (opcional)
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
