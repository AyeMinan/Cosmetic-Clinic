<?php

namespace App\Interfaces;

interface TimeInterface
{
    public function getTime();

    public function storeTime($validatedData);

    public function deleteTime($id);
}
