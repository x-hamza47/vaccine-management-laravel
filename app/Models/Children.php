<?php

namespace App\Models;

use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->hasMany(VaccinationSchedule::class,'child_id');
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

    // INfo: Query Scopes
    public function scopeVisibleTo($query, $user){
        if ($user->can('parent-view')) {
            return $query->where('user_id', $user->id);
        }
        return $query;
    }
}
