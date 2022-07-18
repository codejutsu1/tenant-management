<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PagesController extends Controller
{
    public function dashboardSuperAdmin()
    {
        return Inertia('SuperAdmin/Dashboard');
    }

    public function adminUserDetails(User $user)
    {
        $user = User::where('id', $user->id)
                        ->select(['name', 'email', 'type', 'lga', 'state', 'gender', 'occupation', 'room_no'])
                        ->first();

        return Inertia('SuperAdmin/UserDetails', compact('user'));
    }
}
