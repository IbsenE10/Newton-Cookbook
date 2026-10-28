<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    // alleen de maker van het product mag het aanpassen
    public function update(User $user, Product $product): bool
    {
        return $user->id === $product->user_id;
    }

    // alleen de maker van het product mag het verwijderen
    public function delete(User $user, Product $product): bool
    {
        return $user->id === $product->user_id;
    }
}
