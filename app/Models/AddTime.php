<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddTime extends Model
{
    use HasFactory;

    protected $fillable = [
       'day', 'start_hour', 'start_minute','end_hour','end_minute', 'clinic_id', 

    ];

    public function clinic(){
        return $this->belongsTo(Clinic::class);
    }
}
