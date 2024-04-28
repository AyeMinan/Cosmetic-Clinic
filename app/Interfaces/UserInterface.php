<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface UserInterface
{
    public function getUser();

    public function storeUser($validatedData);

    public function updateUser($id, $password);

    public function deleteUser($id);
}
