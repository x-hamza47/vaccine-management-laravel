<?php

namespace App\Models;

use Carbon\Carbon;
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
    // ! Accessor
    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->format('F j, Y');
    }
}
