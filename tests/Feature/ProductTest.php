<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_create_a_product(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('products.store'), [
                'name' => 'Pancakes',
                'description' => 'Fluffy pancakes',
                'price' => '4.50',
            ])
            ->assertRedirect(route('products.index'));

        $this->assertDatabaseHas('products', ['name' => 'Pancakes']);
    }

    public function test_product_needs_a_name(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('products.store'), ['description' => 'No name', 'price' => '1'])
            ->assertSessionHasErrors('name');

        $this->assertDatabaseCount('products', 0);
    }

    public function test_guest_cannot_create_a_product(): void
    {
        $this->post(route('products.store'), ['name' => 'x', 'description' => 'x', 'price' => '1'])
            ->assertRedirect(route('login'));

        $this->assertDatabaseCount('products', 0);
    }

    public function test_guest_can_view_products(): void
    {
        $this->get(route('products.index'))->assertOk();
    }
}
