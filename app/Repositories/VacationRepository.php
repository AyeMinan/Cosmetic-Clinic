<?php

namespace App\Repositories;

use App\Interfaces\VacationInterface;
use App\Models\Clinic;
use App\Models\Vacation;
use Illuminate\Support\Facades\Session;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class VacationRepository.
 */
class VacationRepository extends BaseRepository implements VacationInterface
{

    public function model()
    {
        return Vacation::class;
    }
  public function getVacation(){
    return view('vacation.index', ['vacations' => Vacation::all(), 'clinics' => Clinic::all()]);
  }

  public function storeVacation($validatedData){
    $vacation = new Vacation();
    $vacation->start_date = $validatedData['start_date'];
    $vacation->end_date = $validatedData['end_date'];
    $vacation->reason = $validatedData['reason'];
    $vacation->clinic_id = $validatedData['clinic_id'];
    $vacation->save();
    Session::flash('success', 'Vacation has been successfully added');
    return redirect()->back();
  }

  public function deleteVacation($id){
    $vacation = Vacation::find($id);
        $vacation->delete();
        Session::flash('success', 'Vacation deleted Successful');
        return redirect()->back();
  }
}
