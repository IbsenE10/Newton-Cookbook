<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $description
 * @property float $price
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
    ];
}
