<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function dashboardSuperAdmin()
    {
        return Inertia('SuperAdmin/Dashboard');
    }
}
