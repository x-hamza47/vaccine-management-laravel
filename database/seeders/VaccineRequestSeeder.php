<?php

namespace Database\Seeders;

use App\Models\Vaccine;
use App\Models\Children;
use App\Models\Hospital;
use App\Models\VaccineRequest;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VaccineRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $childs = Children::inRandomOrder()->take(5)->get();
        $vaccines = Vaccine::where('available', true)->get();
        $hospitals = Hospital::all();

        foreach ($childs as $child) {
            VaccineRequest::create([
                'child_id' => $child->id,
                'vaccine_id' => $vaccines->random()->id,
                'hospital_id' => optional($hospitals->random())->id ?? 1,
                'preferred_date' => now()->addDays(rand(1, 30)),
                'status' => 'pending',
            ]);
        }
    }
}
