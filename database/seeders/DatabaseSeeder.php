<?php

namespace Database\Seeders;

use App\Models\Hospital;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            AdminSeeder::class,
            VaccineSeeder::class,
        ]);

        // !childrens
        User::factory()
        ->count(10)
        ->hasChildren(5)
        ->create([
            'role' => 'parent',
        ]);
        
        // ! Hospitals
        User::factory()
            ->count(10)
            ->hasHospital()
            ->create([
                'role' => 'hospital',
            ]);

        $this->call([
            VaccineRequestSeeder::class,
            VaccineScheduleSeeder::class,
        ]);
    }
}
