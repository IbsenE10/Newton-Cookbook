<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * For now the recipes are a hardcoded list.
     * Later this will come from the database (Recipe model).
     */
    private function getRecipes()
    {
        return [
            [
                'id' => 1,
                'title' => 'Bruschetta with tomato',
                'category' => 'Appetizers',
                'author' => 'Picha',
                'prep_time' => 15,
                'servings' => 4,
                'description' => 'Crispy bread with fresh tomato, garlic and basil.',
                'ingredients' => ['1 baguette', '4 tomatoes', '1 clove of garlic', 'Fresh basil', 'Olive oil', 'Salt and pepper'],
                'instructions' => ['Slice the baguette and toast the slices.', 'Dice the tomatoes and mix with basil, olive oil, salt and pepper.', 'Rub the toast with garlic.', 'Spoon the tomato mix on top and serve.'],
            ],
            [
                'id' => 2,
                'title' => 'Tomato soup',
                'category' => 'Appetizers',
                'author' => 'Sam',
                'prep_time' => 30,
                'servings' => 4,
                'description' => 'A warm and simple soup made from fresh tomatoes.',
                'ingredients' => ['1 kg tomatoes', '1 onion', '1 litre vegetable stock', '1 tbsp tomato paste', 'Salt and pepper'],
                'instructions' => ['Chop the onion and fry it in a pan.', 'Add the tomatoes and tomato paste and cook for 5 minutes.', 'Add the stock and cook for 20 minutes.', 'Blend until smooth and season with salt and pepper.'],
            ],
            [
                'id' => 3,
                'title' => 'Spaghetti bolognese',
                'category' => 'Main dishes',
                'author' => 'Picha',
                'prep_time' => 45,
                'servings' => 4,
                'description' => 'The classic Italian pasta with a rich meat sauce.',
                'ingredients' => ['400 g spaghetti', '500 g minced beef', '1 onion', '2 cloves of garlic', '1 tin of chopped tomatoes', 'Italian herbs'],
                'instructions' => ['Fry the onion and garlic.', 'Add the minced beef and fry until brown.', 'Add the tomatoes and herbs and let it simmer for 30 minutes.', 'Cook the spaghetti and serve with the sauce.'],
            ],
            [
                'id' => 4,
                'title' => 'Chicken curry',
                'category' => 'Main dishes',
                'author' => 'Noor',
                'prep_time' => 40,
                'servings' => 4,
                'description' => 'A mild curry with chicken, coconut milk and rice.',
                'ingredients' => ['500 g chicken breast', '1 tin of coconut milk', '2 tbsp curry paste', '1 onion', '300 g rice'],
                'instructions' => ['Cook the rice.', 'Fry the onion and curry paste.', 'Add the chicken in pieces and fry until cooked.', 'Add the coconut milk and let it simmer for 10 minutes.'],
            ],
            [
                'id' => 5,
                'title' => 'Chocolate mousse',
                'category' => 'Desserts',
                'author' => 'Sam',
                'prep_time' => 20,
                'servings' => 6,
                'description' => 'Light and airy mousse made from dark chocolate.',
                'ingredients' => ['200 g dark chocolate', '4 eggs', '2 tbsp sugar', '200 ml whipped cream'],
                'instructions' => ['Melt the chocolate.', 'Mix the egg yolks with the sugar and stir in the chocolate.', 'Beat the egg whites stiff and fold them in with the cream.', 'Let it set in the fridge for at least 3 hours.'],
            ],
            [
                'id' => 6,
                'title' => 'Apple pie',
                'category' => 'Desserts',
                'author' => 'Noor',
                'prep_time' => 90,
                'servings' => 8,
                'description' => 'Dutch apple pie with cinnamon and a crumbly crust.',
                'ingredients' => ['300 g flour', '200 g butter', '150 g sugar', '1 kg apples', '2 tsp cinnamon', '1 egg'],
                'instructions' => ['Knead the flour, butter, sugar and egg into a dough.', 'Cut the apples and mix with cinnamon and sugar.', 'Line a tin with the dough and add the apples.', 'Make strips on top and bake for 60 minutes at 180 °C.'],
            ],
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = $this->getRecipes();

        return view('recipes.index', [
            'recipes' => $recipes,
            'category' => null,
        ]);
    }

    /**
     * Show only the recipes of one category, for example /recipes/category/desserts.
     */
    public function category(string $category)
    {
        $categories = [
            'appetizers' => 'Appetizers',
            'main-dishes' => 'Main dishes',
            'desserts' => 'Desserts',
        ];

        // Unknown category in the URL? Show a 404 page.
        if (! isset($categories[$category])) {
            abort(404);
        }

        $categoryName = $categories[$category];

        $recipes = [];
        foreach ($this->getRecipes() as $recipe) {
            if ($recipe['category'] === $categoryName) {
                $recipes[] = $recipe;
            }
        }

        return view('recipes.index', [
            'recipes' => $recipes,
            'category' => $categoryName,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        foreach ($this->getRecipes() as $recipe) {
            if ($recipe['id'] == $id) {
                return view('recipes.show', [
                    'recipe' => $recipe,
                ]);
            }
        }

        // No recipe found with this id
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
