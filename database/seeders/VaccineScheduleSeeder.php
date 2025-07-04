<?php

namespace Database\Seeders;

use App\Models\Children;
use App\Models\Hospital;
use App\Models\VaccinationSchedule;
use App\Models\Vaccine;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VaccineScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $childrens = Children::all();
        $hospitals = Hospital::all();
        $vaccines = Vaccine::where('available', true)->get();
        
        foreach ($childrens as $child) {
            $hospital = $hospitals->random()->id ?? 1;
            $vaccine = $vaccines->random();

            VaccinationSchedule::create([
                'child_id' => $child->id,
                'vaccine_id' => $vaccine->id,
                'hospital_id' => $hospital,
                // 'hospital_id' => 8,
                'date' => now()->addDays(rand(1,30)),
                'status' => rand(0,1) ? 'completed' : 'pending',
                // 'status' => 'pending',
            ]);
        }
    }
}
