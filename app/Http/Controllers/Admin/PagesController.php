<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PagesController extends Controller
{
    public function dashboardAdmin()
    {
        return Inertia('Admin/Dashboard');
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

