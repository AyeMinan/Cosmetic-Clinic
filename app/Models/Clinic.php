<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    public function days(){
        return $this->hasMany(Day::class);
    }
    public function vacations(){
        return $this->hasMany(Vacation::class);
    }
    public function addTimes(){
        return $this->hasMany(AddTime::class);
        }
}
