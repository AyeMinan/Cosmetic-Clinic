<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    protected $fillable = ['start_date', 'end_date', 'reason', 'clinic_id'];

    public function clinic(){
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }
}
