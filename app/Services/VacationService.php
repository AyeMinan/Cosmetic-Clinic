<?php

namespace App\Services;

use App\Interfaces\VacationInterface;

class VacationService{
    protected $vacationInterface;

    public function __construct(VacationInterface $vacationInterface){
        $this->vacationInterface = $vacationInterface;
    }

    public function getVacation(){
        return $this->vacationInterface->getVacation();
    }

    public function storeVacation($validatedData){
        return $this->vacationInterface->storeVacation($validatedData);
    }
    public function deleteVacation($id){
        return $this->vacationInterface->deleteVacation($id);
    }
}
