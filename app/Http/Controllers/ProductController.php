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
    public function index(Request $request): View
    {
        // de waarden uit de url, bv. /products?search=cake&category=3
        $search = $request->input('search');
        $categoryId = $request->input('category');

        // with() haalt de makers en categorieën in één keer op, in plaats van een query per product
        $query = Product::with(['user', 'category']);

        // alleen zichtbare recepten, plus je eigen verborgen recepten (zodat je ziet dat ze verborgen zijn)
        $query->where(function ($q) {
            $q->where('is_visible', true)
                ->orWhere('user_id', Auth::id());
        });

        // zoeken: naam OF beschrijving bevat de zoekterm
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // filteren: alleen producten uit de gekozen categorie
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        // pas hier wordt de query echt uitgevoerd
        $products = $query->latest()->get();

        // voor de filterknoppen
        $categories = Category::orderBy('id')->get();

        $user = auth()->user();

        return view('products.index', compact('products', 'user', 'categories', 'search', 'categoryId'));
    }

    public function show(Product $product)
    {
        // verborgen recepten: alleen de maker en de admin (zie ProductPolicy)
        Gate::authorize('view', $product);

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
        Gate::authorize('create', Product::class);

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
        Gate::authorize('create', Product::class);
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

        // kwam je van de admin pagina? dan ga je daar weer naartoe
        $backTo = str_contains(url()->previous(), '/admin') ? route('admin.index') : route('products.index');

        return redirect($backTo)
            ->with('status', 'Product deleted successfully.');
    }
}
