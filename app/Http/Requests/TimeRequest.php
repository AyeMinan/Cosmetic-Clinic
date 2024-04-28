<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeRequest extends FormRequest
{

    // public function authorize(): bool
    // {
    //     return false;
    // }


    public function rules(): array
    {
        return [
            'day' => ['required'],
            'startHour' => ['required'],
            'startMinute' => ['required'],
            'endHour' => ['required'],
            'endMinute' => ['required'],
            'clinic_id' => ['required'],
        ];
    }
}
