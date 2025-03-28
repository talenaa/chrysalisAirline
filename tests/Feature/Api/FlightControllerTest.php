<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Flight;
use App\Models\Airplane;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlightControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfIndexReturnsAllFlights()
    {
        $airplane = Airplane::factory()->create();
        Flight::factory()->count(3)->create(['airplane_id' => $airplane->id]);

        $response = $this->getJson(route('apiflightall'));

        $response->assertOk()
            ->assertJsonCount(3);
    }

    public function test_CheckIfShowReturnsAFlight()
    {
        $airplane = Airplane::factory()->create();
        $flight = Flight::factory()->create(['airplane_id' => $airplane->id]);

        $response = $this->getJson(route('apiflightshow', $flight->id));

        $response->assertOk()
            ->assertJsonFragment([
                'id' => $flight->id,
                'departure' => $flight->departure,
            ]);
    }

    public function test_CheckIfAdminCanStoreAFlight()
    {
        $admin = User::factory()->create(['isAdmin' => true]);
        $airplane = Airplane::factory()->create();

        $data = [
            'date' => now()->addDays(3),
            'departure' => 'Granada',
            'arrival' => 'Valencia',
            'airplane_id' => $airplane->id,
            'disposable' => 1,
        ];

        $response = $this->actingAs($admin, 'api')
            ->postJson(route('apiflightstore'), $data);

        $response->assertOk()
            ->assertJsonFragment(['departure' => 'Granada']);

        $this->assertDatabaseHas('flights', ['arrival' => 'Valencia']);
    }

    public function test_CheckIfAdminCanUpdateAFlight()
    {
        $admin = User::factory()->create(['isAdmin' => true]);
        $airplane = Airplane::factory()->create();
        $flight = Flight::factory()->create(['airplane_id' => $airplane->id]);

        $data = [
            'date' => now()->addDays(5),
            'departure' => 'Alicante',
            'arrival' => 'Paris',
            'airplane_id' => $airplane->id,
            'aviable' => 1,
        ];

        $response = $this->actingAs($admin, 'api')
            ->putJson(route('apiflightupdate', $flight->id), $data);

        $response->assertOk()
            ->assertJsonFragment(['arrival' => 'Paris']);

        $this->assertDatabaseHas('flights', ['departure' => 'Alicante']);
    }

    public function test_CheckIfAdminCanDeleteAFlight()
    {
        $admin = User::factory()->create(['isAdmin' => true]);
        $airplane = Airplane::factory()->create();
        $flight = Flight::factory()->create(['airplane_id' => $airplane->id]);

        $response = $this->actingAs($admin, 'api')
            ->deleteJson(route('apiflightdestroy', $flight->id));

        $response->assertOk();

        $this->assertDatabaseMissing('flights', ['id' => $flight->id]);
    }

    public function test_CheckIfNonAdminCannotStoreFlight()
    {
        $user = User::factory()->create(['isAdmin' => false]);
        $airplane = Airplane::factory()->create();

        $data = [
            'date' => now()->addDays(3),
            'departure' => 'Zaragoza',
            'arrival' => 'Granada',
            'airplane_id' => $airplane->id,
            'disposable' => 1,
        ];

        $response = $this->actingAs($user, 'api')
            ->postJson(route('apiflightstore'), $data);

        $response->assertRedirect('/');
    }
}
