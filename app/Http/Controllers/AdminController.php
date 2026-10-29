<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

// alle routes hiernaartoe zijn beveiligd met 'auth' en 'can:view-admin' (zie routes/web.php)
class AdminController extends Controller
{
    // overzicht van alle recepten van alle gebruikers, ook de verborgen
    public function index(): View
    {
        $products = Product::with(['user', 'category'])->latest()->get();

        $stats = [
            'total' => $products->count(),
            'visible' => $products->where('is_visible', true)->count(),
            'hidden' => $products->where('is_visible', false)->count(),
            'users' => User::count(),
        ];

        return view('layouts.admin', compact('products', 'stats'));
    }

    // recept tonen of verbergen op de products pagina
    public function toggleVisibility(Product $product): RedirectResponse
    {
        // ! draait de waarde om: true wordt false, false wordt true
        $product->is_visible = ! $product->is_visible;
        $product->save();

        $message = $product->is_visible
            ? "\"{$product->name}\" is now visible on the recipes page."
            : "\"{$product->name}\" is now hidden from the recipes page.";

        return redirect()->route('admin.index')->with('status', $message);
    }
}
