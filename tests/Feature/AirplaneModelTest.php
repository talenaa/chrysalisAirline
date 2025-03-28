<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Flight;
use App\Models\Airplane;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AirplaneModelTest extends TestCase
{
    use RefreshDatabase;


    public function test_CheckIfCanCreateAnAirplane()
    {
        $airplane = Airplane::create([
            'name' => 'Boeing 747',
            'seats' => 300
        ]);

        $this->assertDatabaseHas('airplanes', [
            'name' => 'Boeing 747',
            'seats' => 300
        ]);
    }

    public function test_CheckIfHasManyFlights()
    {
        $airplane = Airplane::factory()->create();
        $flights = Flight::factory()->count(3)->create(['airplane_id' => $airplane->id]);

        $this->assertCount(3, $airplane->flights);
        $this->assertTrue($airplane->flights->first() instanceof Flight);
    }
}
