<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    // wordt vóór elke andere check uitgevoerd:
    // true  = admin mag alles, de methodes hieronder worden overgeslagen
    // null  = geen admin, ga verder met de normale check hieronder
    public function before(User $user, string $ability): ?bool
    {
        return $user->isAdmin() ? true : null;
    }

    // iedereen mag een zichtbaar recept bekijken, een verborgen recept alleen de maker (en de admin)
    // ?User omdat gasten (niet ingelogd) ook recepten mogen bekijken
    public function view(?User $user, Product $product): Response
    {
        if ($product->is_visible || $user?->id === $product->user_id) {
            return Response::allow();
        }

        // doe alsof het recept niet bestaat
        return Response::denyAsNotFound();
    }

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
