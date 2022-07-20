<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class NewUserController extends Controller
{
    public function caretakerNewUser()
    {
        return Inertia('Admin/AddNewUser');
    }

    public function caretakerAddUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'lga' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'phone' => 'required|string|min:8|max:16',
            'dob' => 'required|date|date_format:Y-m-d'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('mypassword'),
            'gender' => $request->gender,
            'type' => $request->type,
            'lga' => $request->lga,
            'state' => $request->state,
            'occupation' => $request->occupation,
            'phone' => $request->phone,
            'role_id' => '3',
            'dob' => $request->dob
        ]);

        return redirect()->route('caretaker.new.user')->with('message', 'Successfully registered a new user');
    }
}
