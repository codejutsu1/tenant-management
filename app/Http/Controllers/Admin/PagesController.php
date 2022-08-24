<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Setting;

class PagesController extends Controller
{
    public function dashboardAdmin()
    {
        $room_no = User::where('role_id', 3)
                        ->whereNotNull('room_no')
                        ->pluck('room_no')
                        ->toArray();

        $total_no_of_room = Setting::findOrFail(1)->value('room_numbers');

        $room_no = Array_unique($room_no);
        $number_of_rooms = Count($room_no);

        $total_amount = Transaction::where('status', 1)->sum('amount');

        $paid = User::where('role_id', 3)
                    ->where('paid', 1)
                    ->whereNotNull('room_no')
                    ->pluck('room_no')
                    ->toArray();
        
        $paid_no = Array_unique($paid);
        $number_of_paid_tenants = Count($paid_no);

        $pending_transaction = Transaction::where('paid', 1)
                                        ->whereNull('status')
                                        ->count('amount');

        $total_no_of_tenants = User::where('status', 1)->count('id');

        return Inertia('Admin/Dashboard', compact(
            'total_no_of_room', 
            'number_of_rooms',
            'total_amount',
            'number_of_paid_tenants',
            'pending_transaction',
            'total_no_of_tenants'
        ));
    }

    public function adminUsers()
    {
        $users = User::query()
                    ->where('role_id', 3)
                    ->select(['id', 'name', 'email', 'gender', 'room_no', 'created_at'])
                    ->paginate(10);

        return Inertia('Admin/Allusers', compact('users'));
    }
}

