<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function superAdminSettings()
    {
        return Inertia('SuperAdmin/Settings');
    }
}
