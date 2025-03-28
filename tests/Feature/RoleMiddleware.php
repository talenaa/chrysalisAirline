<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleMiddleware extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware(['web', 'role:admin'])->get('/admin-test', fn () => 'admin ok');
        Route::middleware(['web', 'role:user'])->get('/user-test', fn () => 'user ok');
    }

    public function test_CheckIfAdminCanAccessAdminRoute()
    {
        $admin = User::factory()->create(['isAdmin' => true]);

        $this->actingAs($admin)
             ->get('/admin-test')
             ->assertOk()
             ->assertSee('admin ok');
    }

    public function test_CheckIfNormalUserCannotAccessAdminRoute()
    {
        $user = User::factory()->create(['isAdmin' => false]);

        $this->actingAs($user)
             ->get('/admin-test')
             ->assertRedirect('/')
             ->assertSessionHas('error', 'You do not have permission to be in this page');
    }

    public function test_CheckIfUserCanAccessUserRoute()
    {
        $user = User::factory()->create(['isAdmin' => false]);

        $this->actingAs($user)
             ->get('/user-test')
             ->assertOk()
             ->assertSee('user ok');
    }

    public function test_CheckIfAdminCannotAccessUserRoute()
    {
        $admin = User::factory()->create(['isAdmin' => true]);

        $this->actingAs($admin)
             ->get('/user-test')
             ->assertRedirect('/login')
             ->assertSessionHas('error', 'You must sign up');
    }

    public function test_CheckIfGuestCannotAccessAdminOrUserRoutes()
    {
        $this->get('/admin-test')
             ->assertRedirect('/')
             ->assertSessionHas('error', 'You do not have permission to be in this page');

        $this->get('/user-test')
             ->assertRedirect('/login')
             ->assertSessionHas('error', 'You must sign up');
    }
}
