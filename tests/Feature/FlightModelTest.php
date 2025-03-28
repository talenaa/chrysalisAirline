<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Flight;
use App\Models\Airplane;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlightModelTest extends TestCase
{
    use RefreshDatabase;


    public function test_CheckIfCanCreateAFlightWithFillableFields()
    {
        $airplane = Airplane::factory()->create();

        $flight = Flight::create([
            'date' => now()->addDays(2),
            'departure' => 'Madrid',
            'arrival' => 'Paris',
            'airplane_id' => $airplane->id,
            'disposable' => 1,
        ]);

        $this->assertDatabaseHas('flights', [
            'departure' => 'Madrid',
            'arrival' => 'Paris',
            'airplane_id' => $airplane->id,
        ]);
    }

    public function test_CheckIfBelongsToAnAirplane()
    {
        $airplane = Airplane::factory()->create();
        $flight = Flight::factory()->create(['airplane_id' => $airplane->id]);

        $this->assertInstanceOf(Airplane::class, $flight->airplane);
        $this->assertEquals($airplane->id, $flight->airplane->id);
    }
}
