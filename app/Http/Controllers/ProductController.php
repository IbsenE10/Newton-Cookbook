<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function index(): View
    {
        // with() haalt de makers en categorieën in één keer op, in plaats van een query per product
        $products = Product::with(['user', 'category'])->get();

        $user = auth()->user();

        return view('products.index', compact('products', 'user'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        Gate::authorize('update', $product);

        // voor de dropdown
        $categories = Category::orderBy('id')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        Gate::authorize('update', $product);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'max:2048'],
        ], [
            'category_id.required' => 'Please choose a category.',
            'category_id.exists' => 'Please choose one of the categories in the list.',
        ]);

        //nieuwe foto opslaan en de oude verwijderen
        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            $validated['image_path'] = $request->file('image')->store('products', 'public');
        }

        //bestaande product in database aanpassen
        $product->update($validated);

        return redirect()->route('products.show', $product)
            ->with('status', 'Product updated successfully.');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'max:2048'],
        ], [
            'category_id.required' => 'Please choose a category.',
            'category_id.exists' => 'Please choose one of the categories in the list.',
        ]);

        //foto opslaan in storage/app/public/products
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('products', 'public');
        }

        //info in database zetten, via de relatie wordt user_id automatisch ingevuld
        Auth::user()->products()->create($validated);

        return redirect()->route('products.index')
            ->with('status', 'Product created successfully.');
    }

    public function create(): View
    {
        // voor de dropdown
        $categories = Category::orderBy('id')->get();

        return view('products.create', compact('categories'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        Gate::authorize('delete', $product);

        //foto ook verwijderen
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('status', 'Product deleted successfully.');
    }
}
