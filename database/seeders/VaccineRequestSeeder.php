<?php

namespace Database\Seeders;

use App\Models\Children;
use App\Models\Vaccine;
use App\Models\VaccineRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccineRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $childs = Children::inRandomOrder()->take(5)->get();
        $vaccines = Vaccine::where('available', true)->get();

        foreach ($childs as $child) {
            VaccineRequest::create([
                'child_id' => $child->id,
                'vaccine_id' => $vaccines->random()->id,
                'status' => 'pending',
            ]);
        }
    }
}
