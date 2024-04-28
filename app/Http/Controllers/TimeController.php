<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeRequest;
use App\Models\AddTime;
use App\Models\Day;
use App\Services\TimeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TimeController extends Controller
{
    protected $timeService;

    public function __construct(TimeService $timeService)
    {
        $this->timeService = $timeService;
    }

    public function index()
    {
        $time = $this->timeService->getTime();
        return $time;
    }

    public function store(TimeRequest $timeRequest)
    {
        $validatedData = $timeRequest->validated();
        $data = $this->timeService->storeTime($validatedData);
        return $data;
    }

    public function update($id)
    {
        $time = AddTime::findOrFail($id);
        $time->is_saved = true;
        $time->save();
        Session::flash('success', 'Save Changes Successful');
        return redirect()->back();
    }
    public function destroy($id)
    {
        try {
            $this->timeService->deleteTime($id);
            return response()->json(['message' => 'Time deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete time', 'error' => $e->getMessage()], 500);
        }
    }
}
