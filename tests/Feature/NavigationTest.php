<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NavigationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_see_navigation_without_errors(): void
    {
        $this->view('layouts.navigation')
            ->assertSee('Log in')
            ->assertDontSee('Log Out');
    }

    public function test_logged_in_user_sees_their_name(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->view('layouts.navigation')
            ->assertSee($user->name)
            ->assertDontSee('Register');
    }
}
