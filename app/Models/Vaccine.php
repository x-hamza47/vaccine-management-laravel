<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    protected $guarded = [];

    public function vaccine_schedules(){
        return $this->hasMany(VaccinationSchedule::class);
    }

    public function vaccineRequests()
    {
        return $this->hasMany(VaccineRequest::class);
    }
}
