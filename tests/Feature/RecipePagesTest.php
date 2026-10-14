<?php

use App\Models\User;

it('shows the home, about and contact pages', function () {
    $this->get('/')->assertOk()->assertSee('Main dishes');
    $this->get('/about')->assertOk();
    $this->get('/contact')->assertOk();
});

it('shows all recipes', function () {
    $this->get('/recipes')
        ->assertOk()
        ->assertSee('Bruschetta with tomato')
        ->assertSee('Apple pie');
});

it('shows only the recipes of one category', function () {
    $this->get('/recipes/category/desserts')
        ->assertOk()
        ->assertSee('Apple pie')
        ->assertDontSee('Spaghetti bolognese');
});

it('shows 404 for an unknown category', function () {
    $this->get('/recipes/category/drinks')->assertNotFound();
});

it('shows one recipe', function () {
    $this->get('/recipes/3')
        ->assertOk()
        ->assertSee('Spaghetti bolognese')
        ->assertSee('Ingredients');
});

it('shows 404 for a recipe that does not exist', function () {
    $this->get('/recipes/999')->assertNotFound();
});

it('shows login links to visitors and the dashboard link to logged in users', function () {
    $this->get('/')->assertSee('Log in')->assertDontSee('Dashboard');

    $user = User::factory()->create();
    $this->actingAs($user)->get('/')->assertSee('Dashboard')->assertSee($user->name);
});
