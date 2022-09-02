<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Transaction;
use App\Models\Legal;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role_id', 3)
                    ->where('status', 1)
                    ->select(['id', 'name', 'email', 'gender', 'room_no', 'phone', 'paid', 'rent_due'])
                    ->paginate(10);

        return Inertia('SuperAdmin/Tenants/Index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia('SuperAdmin/Tenants/Create');
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

        User::create([
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

        return redirect()->route('tenants.index')->with('message', 'Successfully registered a new tenant');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)
                        ->select(['id','name', 'email', 'type', 'lga', 'state', 'gender', 'occupation', 'room_no', 'created_at'])
                        ->first();

        $transactions = Transaction::where('user_id', $id)
                                    ->select(['id', 'title', 'amount', 'paid', 'status', 'created_at'])        
                                    ->paginate(10);  

        $receipts = Transaction::where('user_id', $id)
                                    ->select(['id', 'title', 'amount', 'status', 'year', 'link', 'created_at'])
                                    ->paginate(10);

        $legals = Legal::where('user_id', $id)
                        ->select(['id', 'room_no', 'year', 'link', 'created_at'])    
                        ->get();                       

        return Inertia('SuperAdmin/Tenants/Show', compact('user', 'transactions', 'receipts', 'legals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)
                        ->select(['id', 'name', 'email', 'type', 'lga', 'state', 'gender', 'occupation', 'room_no', 'phone', 'dob'])
                        ->first();

        return Inertia('SuperAdmin/Tenants/Edit', compact('user'));
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
        User::where('id', $id)->update(
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => ['required', 'string', 'email', 'max:255','unique:users,email,' . $id],
                'gender' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'lga' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'occupation' => 'required|string|max:255',
                'phone' => 'required|string|min:8|max:16',
                'dob' => 'required|date|date_format:Y-m-d',
                'room_no' => 'numeric'
            ])
        );

        return redirect()->route('tenants.index')->with('message', 'Tenant successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();

        return redirect()->route('tenants.index')->with('message', 'Tenants successfully deleted');
    }
}
