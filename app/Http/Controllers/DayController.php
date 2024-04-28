<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DayController extends Controller
{
    public function update(Request $request, $id){
        $day = Day::findOrFail($id);
        $day->is_holiday = true;
        $day->clinic_id = $request->input('clinic_id');
        $day->save();
        Session::flash('success', 'Set Holiday Successful');
        return redirect()->back();
    }
    public function show($clinicId)
    {
        $holidays = Day::where('is_holiday', true)->where('clinic_id', $clinicId)->get();
        return response()->json($holidays);
    }


    public function cancel($id){
        $day = Day::findOrFail($id);
        $day->is_holiday = false;
        $day->save();
        Session::flash('success', 'Cancel Holiday Successful');
        return redirect()->back();
    }

    public function getHoliday($clinicId, $dayId)
    {
        try {
            // Fetch holiday information based on clinic ID and day ID
            $holiday = Day::where('clinic_id', $clinicId)->where('id', $dayId)->get();

            // Return holiday information as JSON response
            return response()->json($holiday);
        } catch (\Exception $e) {
            // Handle any exceptions and return an error response
            return response()->json(['error' => 'Failed to fetch holiday information.'], 500);
        }

    }

}
