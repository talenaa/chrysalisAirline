<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfUserRegistersSuccessfully(): void
    {
        $response = $this->post(route("register"), [
            "name" => "test",
            "email" => "example@example.com",
            "password" => "12345678",
            "password_confirmation" => "12345678"
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseCount("users", 1);
    }

    public function test_CheckIfUserRegisterFailsDueToMissingConfirmation(): void
    {
        $response = $this->post(route("register"), [
            "name" => "test",
            "email" => "example@example.com",
            "password" => "12345678"
        ]);

        $response->assertStatus(400);
        $this->assertDatabaseCount("users", 0);
    }

    public function test_CheckIfApiUserRegistersSuccessfully(): void
    {
        $response = $this->post("/api/auth/register", [
            "name" => "test",
            "email" => "example@example.com",
            "password" => "12345678",
            "password_confirmation" => "12345678"
        ]);

        $response->assertStatus(201)->assertJsonFragment([
            "name" => "test",
            "email" => "example@example.com"
        ]);
        $this->assertDatabaseCount("users", 1);
    }

    public function test_CheckIfApiUserRegisterFailsDueToInvalidData(): void
    {
        $response = $this->post("/api/auth/register", [
            "name" => "test",
            "email" => "example@example.com",
            "password" => "12345678",
        ]);

        $response->assertStatus(400);
        $this->assertDatabaseCount("users", 0);
    }

    public function test_CheckIfUserCanLoginSuccessfully(): void
    {
        $user = User::factory()->create([
            "email" => "example@example.com",
            "password" => "12345678"
        ]);
        $response = $this->post(route("login"), [
            "email" => $user->email,
            "password" => "12345678"
        ]);

        $response->assertStatus(200);
    }

    public function test_CheckIfUserLoginFailsWithWrongPassword(): void
    {
        $user = User::factory()->create([
            "email" => "example@example.com",
            "password" => "12345678"
        ]);
        $response = $this->post(route("login"), [
            "email" => $user->email,
            "password" => "12345677"
        ]);

        $response->assertStatus(401);
    }

    public function test_CheckIfApiUserCanLoginSuccessfully(): void
    {
        $user = User::factory()->create([
            "email" => "example@example.com",
            "password" => "12345678"
        ]);
        $response = $this->post("/api/auth/login", [
            "email" => "example@example.com",
            "password" => "12345678",
        ]);
        $response->assertStatus(200)->assertJsonStructure(["access_token", "token_type", "expires_in"]);
    }

    public function test_CheckIfApiUserLoginFailsWithInvalidCredentials(): void
    {
        $user = User::factory()->create([
            "email" => "example@example.com",
            "password" => "12345678"
        ]);
        $response = $this->post("/api/auth/login", [
            "email" => "example@example.com",
            "password" => "1234567",
        ]);
        $response->assertStatus(401)->assertJsonFragment(["error" => "Unauthorized"]);
    }

    public function test_CheckIfApiReturnsCurrentAuthenticatedUser(): void
    {
        $credentials = [
            "email" => "example@example.com",
            "password" => "12345678"
        ];
        $user = User::factory()->create($credentials);
        $token = auth("api")->attempt($credentials);
        $response = $this->withHeaders(["Authentication" => "Bearer ".$token])->post(route("me"));

        $response->assertStatus(200)->assertJsonFragment([
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email
        ]);
    }

    public function test_CheckIfApiCanRefreshToken(): void
    {
        $credentials = [
            "email" => "example@example.com",
            "password" => "12345678"
        ];
        $user = User::factory()->create($credentials);
        $token = auth("api")->attempt($credentials);
        $response = $this->withHeaders(["Authentication" => "Bearer ".$token])->post(route("refresh"));

        $response->assertStatus(200)->assertJsonStructure(["access_token", "token_type", "expires_in"]);
    }

    public function test_CheckIfWebUserCanLogoutSuccessfully(): void
    {
        $credentials = [
            "email" => "example@example.com",
            "password" => "12345678"
        ];
        $user = User::factory()->create($credentials);
        $token = auth("api")->attempt($credentials);
        $response = $this->withHeaders(["Authentication" => "Bearer ".$token])->post(route("logout"));

        $response->assertStatus(200);
        $this->assertFalse(auth()->check());
    }

    public function test_CheckIfApiUserCanLogoutSuccessfully(): void
    {
        $credentials = [
            "email" => "example@example.com",
            "password" => "12345678"
        ];
        $user = User::factory()->create($credentials);
        $token = auth("api")->attempt($credentials);
        $response = $this->withHeaders(["Authorization" => "Bearer ".$token])->post("/api/auth/logout");

        $response->assertStatus(200)
                ->assertJsonFragment(["message" => "You are successfully logged out"]);
    }
    
}
