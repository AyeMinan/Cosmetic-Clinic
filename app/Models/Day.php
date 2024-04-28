<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'clinic_id'
    ];

    public function clinic(){
        return $this->belongsTo(Clinic::class);
    }
    public function times(){
        return $this->hasMany(AddTime::class);
    }
}
