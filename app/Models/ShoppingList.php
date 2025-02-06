<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ShoppingList extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    // Relació amb l'usuari creador
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    // Relació amb productes
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Relació amb usuaris (llistes compartides)
    public function sharedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'shopping_list_user');
    }
}

