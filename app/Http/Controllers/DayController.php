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

    public function cancel($id){
        $day = Day::findOrFail($id);
        $day->is_holiday = false;
        $day->save();
        Session::flash('success', 'Cancel Holiday Successful');
        return redirect()->back();
    }

}
