<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VaccinationSchedule extends Model
{
    protected $guarded = [];

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function child()
    {
        return $this->belongsTo(Children::class, 'child_id');
    }
}
