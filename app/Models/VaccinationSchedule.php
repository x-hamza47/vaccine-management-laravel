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
    // ! Query Scopes
    public function scopeVisibleTo($query, $user){
        if($user->can('hospital-view')){
            $hospital = $user->hospital->id;
            return $query->where('hospital_id', $hospital);
        }
        if($user->can('parent-view')){
            $childs = $user->children->pluck('id');
            return $query->whereIn('child_id', $childs);
        }
        return $query;
    }
    public function scopeCompletedOrPast($query, $user){
        if ($user->can('parent-view') || $user->can('hospital-view')) {
            return $query->where(function ($q) {
                $q->where('status', 'completed')
                    ->orWhereDate('date', '<', now());
            });
        }

        return $query;
    }

    // Info: Filters 
    public function scopeApplyFilters($query, $request)
    {
        //  search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('child', function ($childQuery) use ($search) {
                    $childQuery->where('name', 'like', "%{$search}%")
                        ->orWhereHas('parent', function ($p) use ($search) {
                            $p->where('name', 'like', "%{$search}%");
                        });
                })->orWhereHas('vaccine', function ($vaccineQuery) use ($search) {
                    $vaccineQuery->where('name', 'like', "%{$search}%");
                });
            });
        }

        // Admin
        if ($request->filled('hospital_id')) {
            $query->where('hospital_id', $request->hospital_id);
        }

        if ($request->filled('vaccine_id')) {
            $query->where('vaccine_id', $request->vaccine_id);
        }

        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }

        if ($request->filled('status')) {
            if ($request->status === 'missed') {
                $query->where('status', 'pending')
                    ->where('date', '<', Carbon::today());
            } elseif ($request->status === 'pending') {
                $query->where('status', 'pending')
                    ->where('date', '>', Carbon::today());
            } else {
                $query->where('status', $request->status);
            }
        }

        return $query;
    }
 
}
