<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role_id', 3)
                    ->select(['id', 'name', 'email', 'gender', 'room_no', 'phone'])
                    ->paginate(10);

        return Inertia('Admin/Users/Index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia('Admin/User/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
