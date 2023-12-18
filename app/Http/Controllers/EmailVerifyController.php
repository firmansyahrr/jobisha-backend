<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class EmailVerifyController extends Controller
{
    public function verify($user_id, Request $request)
    {
        $user = User::find($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            return redirect(env('APP_FE') . '/email/verify/already-success');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // return redirect(env('APP_FE') . '/email/verify/success');
        return redirect(env('APP_FE'));
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
}
