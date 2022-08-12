<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RoomController extends Controller
{
    public function selectRoom()
    {
        return Inertia('SuperAdmin/SelectRoom');
    }

    public function viewOccupants($id)
    {
        $users = User::where('room_no', $id)
                        ->select(['id', 'name', 'email', 'gender', 'status', 'room_no'])
                        ->get();
    
        return Inertia('SuperAdmin/Room', compact('users'));
    }
}
