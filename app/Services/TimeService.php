<?php

namespace App\Services;

use App\Interfaces\TimeInterface;
use App\Interfaces\VacationInterface;

class TimeService{
    protected $timeInterface;

    public function __construct(TimeInterface $timeInterface){
        $this->timeInterface = $timeInterface;
    }

    public function getTime(){
        return $this->timeInterface->geTtime();
    }

    public function storeTime($validatedData){
        return $this->timeInterface->storeTime($validatedData);
    }
    public function deleteTime($id){
        return $this->timeInterface->deleteTime($id);
    }
}
