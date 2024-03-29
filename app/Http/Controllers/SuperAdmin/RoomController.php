<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;

class RoomController extends Controller
{
    public function selectRoom()
    {
        $room_numbers = Setting::where('id', 1)->value('room_numbers');

        return Inertia('SuperAdmin/SelectRoom', compact('room_numbers'));
    }

    public function viewOccupants($id)
    {
        $users = User::where('room_no', $id)
                        ->select(['id', 'name', 'email', 'gender', 'status', 'room_no'])
                        ->get();
    
        return Inertia('SuperAdmin/Room', compact('users', 'id'));
    }

    public function changeRoom($id)
    {
        $room_numbers = Setting::where('id', 1)->value('room_numbers');

        $users = User::where('room_no', $id)
                        ->select(['id', 'name'])
                        ->get();

        return Inertia('SuperAdmin/ChangeRoom', compact('users', 'id', 'room_numbers'));
    }

    public function changeRoomTenant($id)
    {
        $room_numbers = Setting::where('id', 1)->value('room_numbers');

        $user = User::where('id', $id)->select(['id','name', 'room_no'])->first();

        return Inertia('SuperAdmin/ChangeTenantRoom', compact('user', 'room_numbers'));
    }

    public function changeRoomNumber(Request $request, $id)
    {
        User::where('room_no', $id)->update(
            $request->validate([
                'room_no' => 'numeric' 
            ])
        );

        return redirect()->route('select.room')->with('message', 'Successfully changed tenant room.');
    }

    public function changeTenantNumber(Request $request, $id)
    {
        User::where('id', $id)->update(
            $request->validate([
                'room_no' => 'numeric' 
            ])
        );

        return redirect()->route('select.room')->with('message', 'Successfully changed tenant room.');

    }
}
