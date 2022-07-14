<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            if(Auth::check() && Auth::user()->role_id == 1){
                return redirect()->intended(RouteServiceProvider::LANDLORD);
            }elseif(Auth::check() && Auth::user()->role_id == 3) {
                return redirect()->intended(RouteServiceProvider::TENANT);
            }else{
                return redirect()->intended(RouteServiceProvider::CARETAKER);
            }
            // return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
