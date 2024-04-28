<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacationRequest extends FormRequest
{

    // public function authorize(): bool
    // {
    //     return false;
    // }


    public function rules(): array
    {
        return [
           'start_date' => ['required'],
           'end_date' => ['required'],
           'reason' => ['required'],
           'clinic_id' => ['required']
        ];
    }
}
