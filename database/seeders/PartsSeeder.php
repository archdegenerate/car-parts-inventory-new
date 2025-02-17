<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Part;
use App\Models\Car;

class PartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure there are cars in the database
        $cars = Car::all();

        if ($cars->isEmpty()) {
            $this->command->info('No cars found! Running CarSeeder first.');
            $this->call(CarSeeder::class);
            $cars = Car::all(); // Reload cars after seeding
        }

        // Seed parts for each car
        foreach ($cars as $car) {
            Part::create([
                'name' => 'Brake Pad',
                'serialnumber' => 'BP-' . strtoupper(uniqid()),
                'car_id' => $car->id,
            ]);

            Part::create([
                'name' => 'Air Filter',
                'serialnumber' => 'AF-' . strtoupper(uniqid()),
                'car_id' => $car->id,
            ]);

            Part::create([
                'name' => 'Spark Plug',
                'serialnumber' => 'SP-' . strtoupper(uniqid()),
                'car_id' => $car->id,
            ]);
        }
    }
}
