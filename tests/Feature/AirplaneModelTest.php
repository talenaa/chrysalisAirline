<?php

namespace Tests\Feature;

use Tests\TestCase;
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
}
