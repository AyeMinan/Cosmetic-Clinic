<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function index() {
       $user = $this->userService->getUser();
       return $user;
    }

    public function create(){
        return view('account.create');
    }
    public function store(UserRequest $userRequest)
    {
        try {

            $validatedData = $userRequest->validated();
            $data = $this->userService->storeUser($validatedData);
            return $data;

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    public function edit(){
        return view('account.edit');
    }
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'password' => 'required|min:8',
        'confirm_password' => 'required|same:password',
    ]);

    $updated = $this->userService->updateUser($id, $validatedData['password']);

    if ($updated) {
        Session::flash('success', "Password Updated Successfully");
    } else {
        Session::flash('error', "User not found");
    }

    return redirect()->back();

}

public function destroy($id){
    $data = $this->userService->deleteUser($id);
    return $data;
}

}
