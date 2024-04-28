<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacationRequest;
use App\Models\Vacation;
use App\Services\VacationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VacationController extends Controller
{

    protected $vacationService;

    public function __construct(VacationService $vacationService){
        $this->vacationService = $vacationService;
    }
    public function index()
    {
        $vacation = $this->vacationService->getVacation();
        return $vacation;
    }

    public function show($clinicId)
    {
        $vacations = Vacation::where('clinic_id', $clinicId)->get();
        return response()->json($vacations);
    }
    public function store(VacationRequest $vacationRequest)
    {

        $validatedData = $vacationRequest->validated();
        $data = $this->vacationService->storeVacation($validatedData);
        return $data;
    }

    public function destroy($id)
    {
        $result = $this->vacationService->deleteVacation($id);
        return $result;
    }
}
