<?php

namespace App\Http\Controllers;

use App\Models\AddTime;
use App\Models\Clinic;
use App\Models\Day;
use Illuminate\Http\Request;

class ClinicController extends Controller
{

    public function saveChanges(Request $request)
{
    // Retrieve data from the request
    $clinicId = $request->input('id');
    $name = $request->input('name');
    $day = $request->input('day');
    $startHour = $request->input('start_hour');
    $startMinute = $request->input('start_minute');
    $endHour = $request->input('end_hour');
    $endMinute = $request->input('end_minute');

    // Example of saving the data to your database using Eloquent ORM
    Clinic::create([
        'id' => $clinicId,
        'name' => $name,
        'day' => $day,
        'start_hour' => $startHour,
        'start_minute' => $startMinute,
        'end_hour' => $endHour,
        'end_minute' => $endMinute,
    ]);

    // Optionally, return a response
    return response()->json(['message' => 'Changes saved successfully']);
}
}
