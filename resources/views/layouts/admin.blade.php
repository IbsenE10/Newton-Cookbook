<x-app-layout>
    <div class="site-main">
        <header class="page-header">
            <div>
                <h1 class="page-header__title">Admin</h1>
                <p class="page-header__subtitle">Manage all recipes from every cook</p>
            </div>
        </header>

        @if (session('status'))
            <p class="alert">{{ session('status') }}</p>
        @endif

        {{-- Cijfers --}}
        <div class="admin-stats">
            <div class="admin-stat">
                <span class="admin-stat__number">{{ $stats['total'] }}</span>
                <span class="admin-stat__label">Recipes</span>
            </div>
            <div class="admin-stat admin-stat--visible">
                <span class="admin-stat__number">{{ $stats['visible'] }}</span>
                <span class="admin-stat__label">Visible</span>
            </div>
            <div class="admin-stat admin-stat--hidden">
                <span class="admin-stat__number">{{ $stats['hidden'] }}</span>
                <span class="admin-stat__label">Hidden</span>
            </div>
            <div class="admin-stat">
                <span class="admin-stat__number">{{ $stats['users'] }}</span>
                <span class="admin-stat__label">Cooks</span>
            </div>
        </div>

        {{-- Alle recepten --}}
        <section class="card">
            <header class="card__header admin-table__header">
                <h2>All recipes</h2>
            </header>

            @if ($products->isEmpty())
                <p class="card__body">There are no recipes yet.</p>
            @else
                {{-- de wrapper laat de tabel horizontaal scrollen op kleine schermen --}}
                <div class="admin-table__wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Recipe</th>
                                <th>Cook</th>
                                <th>Category</th>
                                <th>Added</th>
                                <th>Status</th>
                                <th class="admin-table__actions-head">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="{{ $product->is_visible ? '' : 'is-hidden' }}">
                                    <td>
                                        <a href="{{ route('products.show', $product) }}" class="admin-recipe">
                                            @if ($product->image_path)
                                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="">
                                            @else
                                                <img src="{{ asset('images/logo.webp') }}" alt="" class="admin-recipe__placeholder">
                                            @endif
                                            <span>{{ $product->name }}</span>
                                        </a>
                                    </td>
                                    <td>{{ $product->user?->name ?? 'unknown' }}</td>
                                    <td>
                                        @if ($product->category)
                                            <span class="category-badge category-badge--{{ Str::slug($product->category->name) }}">{{ $product->category->name }}</span>
                                        @else
                                            <span class="admin-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="admin-muted">{{ $product->created_at?->format('d M Y') }}</td>
                                    <td>
                                        <span class="status {{ $product->is_visible ? 'status--visible' : 'status--hidden' }}">
                                            {{ $product->is_visible ? 'Visible' : 'Hidden' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="admin-actions">
                                            {{-- tonen / verbergen --}}
                                            <form method="POST" action="{{ route('admin.products.visibility', $product) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn--sm {{ $product->is_visible ? 'btn--ghost' : 'btn--primary' }}">
                                                    {{ $product->is_visible ? 'Hide' : 'Show' }}
                                                </button>
                                            </form>

                                            <a href="{{ route('products.edit', $product) }}" class="btn btn--outline btn--sm">Edit</a>

                                            <form method="POST" action="{{ route('products.destroy', $product) }}">
                                                @csrf
                                                @method('DELETE')
                                                {{-- Js::from maakt de naam veilig binnen JavaScript --}}
                                                <button type="submit" onclick="return confirm({{ \Illuminate\Support\Js::from('Delete "' . $product->name . '"? This cannot be undone.') }})" class="btn btn--danger btn--sm">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </div>
</x-app-layout>
