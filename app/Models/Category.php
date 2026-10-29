<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 */
class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    // een categorie heeft veel producten
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
