<?php

namespace App\Repositories;

use App\Interfaces\TimeInterface;
use App\Models\AddTime;
use App\Models\Clinic;
use App\Models\Day;
use Illuminate\Support\Facades\Session;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class TimeRepository.
 */
class TimeRepository extends BaseRepository implements TimeInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return AddTime::class;
    }

    public function getTime(){
        $days = Day::all();
        $addedTimes = [];
        $clinics = Clinic::all();

        foreach($days as $day){
            $addedTimes[] = AddTime::where('day', $day->name)->get();
        }

        return view('clinicHours.index', [
            'days' => $days,
            'addedTimes' => $addedTimes,
            'clinics' => $clinics
        ]);
    }

    public function storeTime($validatedData){
        $addTime = new AddTime();
        $addTime->day = $validatedData['day'];
        $addTime->start_hour = $validatedData['startHour'];
        $addTime->start_minute = $validatedData['startMinute'];
        $addTime->end_hour = $validatedData['endHour'];
        $addTime->end_minute = $validatedData['endMinute'];
        $addTime->clinic_id = $validatedData['clinic_id'];
        $addTime->save();

         return response()->json(['message' => 'Time added successfully']);
    }

    public function deleteTime($id){
        $time = AddTime::findOrFail($id);
        $time->delete();
        Session::flash('success', "Time deleted Successful");
        return redirect()->back();
    }
}
