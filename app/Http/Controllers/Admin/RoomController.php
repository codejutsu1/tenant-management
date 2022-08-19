<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RoomController extends Controller
{
    public function adminSelectRoom()
    {
        return Inertia('Admin/SelectRoom');
    }

    public function adminViewOccupants($id)
    {
        $users = User::where('room_no', $id)
                        ->select(['id', 'name', 'email', 'gender', 'status', 'room_no'])
                        ->get();
    
        return Inertia('Admin/Room', compact('users', 'id'));
    }

    public function adminChangeRoom($id)
    {
        $users = User::where('room_no', $id)
                        ->select(['id', 'name'])
                        ->get();

        return Inertia('Admin/ChangeRoom', compact('users', 'id'));
    }

    public function adminRoomTenant($id)
    {
        $user = User::where('id', $id)->select(['id','name', 'room_no'])->first();

        return Inertia('Admin/ChangeTenantRoom', compact('user'));
    }

    public function adminRoomNumber(Request $request, $id)
    {
        User::where('room_no', $id)->update(
            $request->validate([
                'room_no' => 'numeric' 
            ])
        );

        return redirect()->route('admin.select.room')->with('message', 'Successfully changed tenant room.');
    }

    public function adminTenantNumber(Request $request, $id)
    {
        User::where('id', $id)->update(
            $request->validate([
                'room_no' => 'numeric' 
            ])
        );

        return redirect()->route('admin.select.room')->with('message', 'Successfully changed tenant room.');

    }
}
