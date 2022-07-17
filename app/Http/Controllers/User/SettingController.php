<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;

class SettingController extends Controller
{
    public function userSettings()
    {
        $user = User::query()
                    ->where('id', auth()->user()->id)
                    ->select(['name', 'email'])
                    ->first();

        return Inertia('User/Settings', compact('user'));
    }

    public function userEdit()
    {
        $user = User::where('id', auth()->user()->id)
                    ->select(['gender', 'occupation', 'state', 'lga'])
                    ->first();
                 
        return Inertia('User/UserEdit', compact('user'));                    
    }

    public function updateTenant(Request $request)
    {
        $request->validate([
            'gender' => ['required', 'string', 'max:255'],
            'occupation' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'lga' => ['required', 'string', 'max:255'],
        ]);
    
        User::findOrFail(auth()->user()->id)->update([
            'gender' => $request->gender,
            'occupation' => $request->occupation,
            'state' => $request->state,
            'lga' => $request->lga,
        ]);

        return redirect()->route('user.details')
                ->with('messsage', 'Successfully updated');
    }

    public function updateTenantEmail(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->user()->id],
            'password' => ['required', 'confirmed', new MatchOldPassword],
        ]);

        User::findOrFail(auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->route('user.details')
                ->with('message', 'Successfully update name and email');
    }

    public function updateTenantPassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'confirmed']
        ]);

        User::findOrFail(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('user.details')
                ->with('message', 'Password successfully updated');
    }
}
