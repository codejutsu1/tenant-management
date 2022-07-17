<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;

class SettingController extends Controller
{
    public function adminSettings()
    {
        $user = User::query()
                    ->where('id', auth()->user()->id)
                    ->select(['name', 'email'])
                    ->first();

        return Inertia('Admin/Settings', compact('user'));
    }

    public function updateCaretakerEmail(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users,email,' . auth()->user()->id],
            'password' => ['required', 'confirmed', new MatchOldPassword]
        ]);

        User::findOrFail(auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->back()
                ->with('message', 'Name and Email successfully updated');
    }

    public function updateCaretakerPassword(Request $request)
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
}
