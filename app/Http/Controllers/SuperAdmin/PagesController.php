<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;

class PagesController extends Controller
{
    public function dashboardSuperAdmin()
    {
        $room_no = User::where('role_id', 3)
                        ->whereNotNull('room_no')
                        ->pluck('room_no')
                        ->toArray();

        $total_no_of_room = Setting::findOrFail(1)->value('room_numbers');

        $room_no = Array_unique($room_no);
        $number_of_rooms = Count($room_no);

        $total_amount = Transaction::where('status', 1)->count('amount');
        
        return Inertia('SuperAdmin/Dashboard', compact(
            'total_no_of_room', 
            'number_of_rooms',
            'total_amount'
        ));
    }

    public function allUsers()
    {
        $users = User::query()
                    ->where('role_id', 3)
                    ->select(['id', 'name', 'email', 'gender', 'room_no', 'status', 'created_at', 'date_left'])
                    ->paginate(10);
        
        return Inertia('SuperAdmin/Allusers', compact('users'));                    
    }


}
