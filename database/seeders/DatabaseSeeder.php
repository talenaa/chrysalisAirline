<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Airplane;
use App\Models\Flight;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //Users seed
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '12345678',
            'isAdmin' => 1
        ]);

        User::create([
            'name' => 'User1',
            'email' => 'user1@user.com',
            'password' => '12345678',
            'isAdmin' => 0
        ]);

        User::create([
            'name' => 'User2',
            'email' => 'user2@user.com',
            'password' => '12345678',
            'isAdmin' => 0
        ]);

        User::create([
            'name' => 'User3',
            'email' => 'user3@user.com',
            'password' => '12345678',
            'isAdmin' => 0
        ]);

        User::create([
            'name' => 'User4',
            'email' => 'user4@user.com',
            'password' => '12345678',
            'isAdmin' => 0
        ]);

        //Planes seed
        Plane::create([
            'name' => 'Boeing 737',
            'max_capacity' => 150,
        ]);

        Plane::create([
            'name' => 'Airbus A320',
            'max_capacity' => 160,
        ]);

        Plane::create([
            'name' => 'Embraer E190',
            'max_capacity' => 110,
        ]);

        Plane::create([
            'name' => 'Bombardier CRJ900',
            'max_capacity' => 120,
        ]);

        Plane::create([
            'name' => 'Boeing 777',
            'max_capacity' => 180,
        ]);

        Plane::create([
            'name' => 'Airbus A350',
            'max_capacity' => 170,
        ]);

        Plane::create([
            'name' => 'Boeing 787 Dreamliner',
            'max_capacity' => 160,
        ]);

        Plane::create([
            'name' => 'Airbus A330',
            'max_capacity' => 150,
        ]);

        Plane::create([
            'name' => 'Embraer E175',
            'max_capacity' => 130,
        ]);

        Plane::create([
            'name' => 'Bombardier Q400',
            'max_capacity' => 140,
        ]);

        //Flights seed
        Flight::create([
            'date' => '2025-02-25',
            'departure' => 'New York, USA',
            'arrival'   => 'London, UK',
            'plane_id'  => 1,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2025-02-24',
            'departure' => 'Paris, France',
            'arrival'   => 'Tokyo, Japan',
            'plane_id'  => 2,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2025-02-23',
            'departure' => 'Sydney, Australia',
            'arrival'   => 'Berlin, Germany',
            'plane_id'  => 3,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2025-02-22',
            'departure' => 'Madrid, Spain',
            'arrival'   => 'Rome, Italy',
            'plane_id'  => 4,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2025-02-21',
            'departure' => 'Dubai, UAE',
            'arrival'   => 'Toronto, Canada',
            'plane_id'  => 5,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2025-02-20',
            'departure' => 'Moscow, Russia',
            'arrival'   => 'Beijing, China',
            'plane_id'  => 6,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2025-02-19',
            'departure' => 'Los Angeles, USA',
            'arrival'   => 'Madrid, Spain',
            'plane_id'  => 7,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2025-02-18',
            'departure' => 'Lisbon, Portugal',
            'arrival'   => 'Dublin, Ireland',
            'plane_id'  => 8,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2025-02-17',
            'departure' => 'Rome, Italy',
            'arrival'   => 'Cairo, Egypt',
            'plane_id'  => 9,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2025-02-16',
            'departure' => 'Amsterdam, Netherlands',
            'arrival'   => 'Brussels, Belgium',
            'plane_id'  => 10,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        // Future Flights (dates far after 2025-02-26)
        Flight::create([
            'date' => '2025-12-31',
            'departure' => 'Seoul, South Korea',
            'arrival'   => 'Singapore, Singapore',
            'plane_id'  => 1,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2026-03-15',
            'departure' => 'Buenos Aires, Argentina',
            'arrival'   => 'Santiago, Chile',
            'plane_id'  => 2,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2026-07-04',
            'departure' => 'Istanbul, Turkey',
            'arrival'   => 'Moscow, Russia',
            'plane_id'  => 3,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2026-11-11',
            'departure' => 'Berlin, Germany',
            'arrival'   => 'Madrid, Spain',
            'plane_id'  => 4,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2027-05-05',
            'departure' => 'Toronto, Canada',
            'arrival'   => 'New York, USA',
            'plane_id'  => 5,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2027-09-09',
            'departure' => 'Paris, France',
            'arrival'   => 'Rome, Italy',
            'plane_id'  => 6,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2028-01-01',
            'departure' => 'London, UK',
            'arrival'   => 'Dubai, UAE',
            'plane_id'  => 7,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2028-04-20',
            'departure' => 'Tokyo, Japan',
            'arrival'   => 'Sydney, Australia',
            'plane_id'  => 8,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2028-08-08',
            'departure' => 'Cairo, Egypt',
            'arrival'   => 'Istanbul, Turkey',
            'plane_id'  => 9,
            'reserved'  => 0,
            'aviable'   => true,
        ]);

        Flight::create([
            'date' => '2029-02-26',
            'departure' => 'Beijing, China',
            'arrival'   => 'Seoul, South Korea',
            'plane_id'  => 10,
            'reserved'  => 0,
            'aviable'   => true,
        ]);
    }
}
