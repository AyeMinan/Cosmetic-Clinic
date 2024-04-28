<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository implements UserInterface
{

    public function model()
    {
        return User::class;
    }

    public function getUser(){
        $user = auth()->user();
        return view('account.index', ['users' => User::where('id', '!=', $user->id)->get()]);
    }


    public function storeUser($validatedData){
        $user = new User();
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->save();

        Session::flash('success', 'User created successfully');
        return redirect()->back();
    }

    public function updateUser($id, $password){
        $user = User::find($id);
        if (!$user) {

            return false;
        }

        $user->password = Hash::make($password);
        $user->save();

        return true;
    }

    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        Session::flash('success', "User deleted Successful");
        return redirect()->back();
    }
}
