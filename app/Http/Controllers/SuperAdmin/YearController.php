<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function showTenantsYearly()
    {
        return Inertia('SuperAdmin/Year');
    }
}
