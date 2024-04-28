<?php

namespace App\Interfaces;

interface VacationInterface
{
    public function getVacation();

    public function storeVacation($validatedData);

    public function deleteVacation($id);
}
