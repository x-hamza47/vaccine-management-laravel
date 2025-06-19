<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hospital extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getShortAddressAttribute(){
        return Str::limit($this->address, 20, '...');
    }
}
