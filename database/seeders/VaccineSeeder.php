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
        // $vaccines = ['Polio', 'BCG', 'Hepatitis B', 'MMR'];
        $vaccines = [
            'DTP Vaccine',
            'Hib Vaccine',
            'Rotavirus Vaccine',
            'Pneumococcal Vaccine',
            'Chickenpox Vaccine',
            'Hepatitis A Vaccine',
            'Typhoid Vaccine',
            'Influenza Vaccine',
            'COVID-19 Vaccine',
            'HPV Vaccine',
            'JE Vaccine'
        ];

        foreach($vaccines as $vaccine){
            Vaccine::create(['name' => $vaccine]);
        }
    }
}
