<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Car::create([
            'name' => 'Toyota Corolla',
            'registration_number' => 'AB123CD',
            'is_registered' => true,
        ]);
    }
}
