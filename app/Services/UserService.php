<?php

namespace App\Services;

use App\Interfaces\UserInterface;

class UserService{
    protected $userInterface;

    public function __construct(UserInterface $userInterface){
        $this->userInterface = $userInterface;
    }

    public function getUser(){
        return $this->userInterface->getUser();
    }

    public function storeUser($validatedData){
        return $this->userInterface->storeUser($validatedData);
    }
    public function updateUser($id, $password){
        return $this->userInterface->updateUser($id,$password);
    }
    public function deleteUser($id){
        return $this->userInterface->deleteUser($id);
    }
}
