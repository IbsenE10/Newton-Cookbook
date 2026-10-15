<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    public static function create(array $validated)
    {
        return static::create($validated);
    }
}
