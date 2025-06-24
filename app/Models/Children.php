<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Children extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function vaccinationSchedules()
    {
        return $this->hasOne(VaccinationSchedule::class,'child_id');
    }

    public function vaccineRequests(){
        return $this->hasMany(VaccineRequest::class);
    }

    public function vaccine(){
        return $this->hasOneThrough(
            Vaccine::class,
            VaccinationSchedule::class,
            'child_id', 
            'id',
            'id',
            'vaccine_id'
        );
    }
}
