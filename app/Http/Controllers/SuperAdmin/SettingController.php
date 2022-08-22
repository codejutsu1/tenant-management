<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use App\Models\Setting;

class SettingController extends Controller
{
    public function superAdminSettings()
    {
        $settings = Setting::first();
        
        return Inertia('SuperAdmin/Settings', compact('settings'));
    }

    public function updateSiteInfo(Request $request)
    {
        Setting::findOrFail(auth()->user()->id)->update(
            $request->validate([
                'site_name' => 'required|string',
                'site_email' => 'required|email',
                'site_phone' => 'required|numeric',
                'site_rent' => 'required|numeric',
                'room_numbers' => 'required|numeric'
            ])
        );

        return redirect()->back()
                ->with('message', 'Site Info successfully updated.');
    }

    public function updateLandlordPassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'confirmed']
        ]);

        User::findOrFail(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()
                ->with('message', 'Password successfully updated');
    }


    public function landlordActivateUser($id)
    {
        User::where('id', $id)->update([
            'status' => 1
        ]);

        return redirect()->back()
                    ->with('message', 'You have successfully activated this tenant.');
    }

    public function landlordDeactivateUser($id)
    {
        User::where('id', $id)->update([
            'status' => 0
        ]);

        return redirect()->back()
                    ->with('message', 'You have successfully deactivated this tenant.');
    }
}
