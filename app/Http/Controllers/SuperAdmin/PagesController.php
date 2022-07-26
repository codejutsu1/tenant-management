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

    public function allUsers()
    {
        $users = User::query()
                    ->where('role_id', 3)
                    ->select(['id', 'name', 'email', 'gender', 'room_no', 'created_at'])
                    ->paginate(10);
        
        return Inertia('SuperAdmin/Allusers', compact('users'));                    
    }
}
