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

        // $this->call([
        //     AdminSeeder::class,
        // ]);

        // !childrens
        // User::factory()
        //     ->count(3)
        //     ->hasChildren(5)
        //     ->create();

        // ! Hospitals
        User::factory()
            ->count(1)
            ->hasHospital()
            ->create();
    }
}
