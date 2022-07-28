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

    public function landlordChangeRoom()
    {
        $users = User::query()
                    ->where('role_id', 3)
                    ->select(['id', 'name', 'email', 'gender', 'status', 'room_no'])
                    ->paginate(10);

        return Inertia('SuperAdmin/ChangeRoom', compact('users'));
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

    public function landlordChangeNumber(Request $request, $id)
    {
        dd($request);
    }
}
