<?php

namespace Database\Seeders;

use App\Models\Vaccine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vaccines = ['Polio', 'BCG', 'Hepatitis B', 'MMR'];

        foreach($vaccines as $vaccine){
            Vaccine::create(['name' => $vaccine]);
        }
    }
}
