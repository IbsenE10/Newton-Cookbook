<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $name
 * @property string $description
 * @property float $price
 * @property string|null $image_path
 * @property int|null $user_id
 * @property int|null $category_id
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image_path',
        'category_id',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // een product hoort bij één categorie
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

}
