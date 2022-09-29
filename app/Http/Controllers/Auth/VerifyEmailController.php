<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeUser;
use App\Mail\AdminWelcomeUser;
use App\Models\User;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::TENANT.'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));

            $user = User::where('id', auth()->user()->id)->first();
            Mail::to($request->user()->email)->send(new WelcomeUser($user));
            Mail::to(config('mail.from.address'))->send(new AdminWelcomeUser($user));
        }

        return redirect()->intended(RouteServiceProvider::TENANT.'?verified=1');
    }
}
