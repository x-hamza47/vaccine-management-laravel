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
}
