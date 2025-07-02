<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VaccineRequest extends Model
{
    protected $guarded = [];

    public function child(){
        return $this->belongsTo(Children::class,'child_id');
    }
    
    public function vaccine(){
        return $this->belongsTo(Vaccine::class);
    }

    public function getGenderAttribute(){
        return ucfirst($this->child->gender);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
    public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->preferred_date)->format('F j, Y');
    }
}
