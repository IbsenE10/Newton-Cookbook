<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public mixed $name;
    public mixed $description;
    public mixed $price;
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
