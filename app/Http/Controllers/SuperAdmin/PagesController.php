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
}
